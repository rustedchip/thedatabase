<?php

namespace Rustedchip\TheDatabase;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;


class TheDatabaseController extends Controller
{
 

    /* PROTECTED  */
    public $protected_tables = array('migrations','failed_jobs','password_resets','personal_access_tokens');
    public $protected_fields = array('id','created_at','updated_at','password');

    public function thedatabasetables()
    {
  
        /* TABLES  */
        $tables = Schema::getAllTables();
        $tables = array_map('current', $tables);
        $tables = array_diff($tables, $this->protected_tables);

        return view('thedatabase::thedatabasetables', compact('tables'));
    }
    public function thetablerows(request $request, $table)
    {
        $search = $request->search;

        $columns = Schema::getColumnListing($table);

        /* FIRST COLUMN FOR ORDERY BY */
        $first_column  = array_values($columns)[0];;

        if ((isset($search)) && !empty($search)) {
            $statement = '';
            foreach ($columns as $key => $column) {
                if ($key === array_key_first($columns)) {
                    $statement = $statement . " " . $column . " LIKE '%" . $search . "%'";
                } else {
                    $statement = $statement . " OR " . $column . " LIKE '%" . $search . "%'";
                }
            }
            $rows = DB::table($table)->whereRaw($statement)->orderBy($first_column, 'DESC')->paginate(25);
        } else {
            $rows = DB::table($table)->orderBy($first_column, 'DESC')->paginate(25);
        }

        $protected_fields = $this->protected_fields;

        return view('thedatabase::thetablerows', compact('columns', 'rows', 'table', 'search','protected_fields'));
    }

    public function tablerowupdate(request $request, $table, $row)
    {

        $columns = Schema::getColumnListing($table);
        $first_column  = array_values($columns)[0];
        $statement = array();

        foreach ($columns as $column) {
            /* PROTECTED  */
            if(!in_array($column, $this->protected_fields)){
                $statement[$column] = $request->$column;
            }
        }

        /* ROWS */
        $rows = DB::table($table)->orderBy($first_column, 'DESC')->paginate(25);
        
       
        $protected_fields = $this->protected_fields;

        try {
            $update = DB::table($table)->where($first_column, $row)->update($statement);

            Session()->put('toast', 'Row has been Updated');
            return view('thedatabase::thetablerows', compact('columns', 'rows', 'table','protected_fields'));

        } catch (QueryException $e) {
            Session()->put('toast', 'MYSQL Error');
            return view('thedatabase::thetablerows', compact('columns', 'rows', 'table','protected_fields'));
        }
        


    }
    public function tablerowinsert(request $request, $table)
    {

        $columns = Schema::getColumnListing($table);
        $first_column  = array_values($columns)[0];

        $statement = array();
        
        foreach ($columns as $column) {
            /* PROTECTED  */
            if(!in_array($column, $this->protected_fields)){
                $statement[$column] = $request->$column;
            }
        }

        

        /* ROWS */
        $rows = DB::table($table)->orderBy($first_column, 'DESC')->paginate(25);

        
        $protected_fields = $this->protected_fields;
       

        try {
            $insert = DB::table($table)->insert($statement);

            Session()->put('toast', 'Row has been Inserted');
            return view('thedatabase::thetablerows', compact('columns', 'rows', 'table','protected_fields'));

        } catch (QueryException $e) {
            Session()->put('toast', 'MYSQL Error');
            return view('thedatabase::thetablerows', compact('columns', 'rows', 'table','protected_fields'));
        }


    }
    public function tablerowdelete($table, $row)
    {

        $columns = Schema::getColumnListing($table);
        $first_column  = array_values($columns)[0];
        

        /* ROWS */
        $rows = DB::table($table)->orderBy($first_column, 'DESC')->paginate(25);

        /* TOAST MESSAGE */
       
        $protected_fields = $this->protected_fields;


        try {
            $delete = DB::table($table)->where($first_column, $row)->delete();

            Session()->put('toast', 'Row has been Deleted');
            return view('thedatabase::thetablerows', compact('columns', 'rows', 'table','protected_fields'));

        } catch (QueryException $e) {
            Session()->put('toast', 'MYSQL Error');
            return view('thedatabase::thetablerows', compact('columns', 'rows', 'table','protected_fields'));
        }


    }
}
