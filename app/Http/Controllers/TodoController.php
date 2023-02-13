<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    /**
        * Display a listing of the resource.
        *
        * @return Response
        */
        public function index()
        {
            $todos = Todo::all();

            return view('todo')->with(compact('todos'));
        }
    
        /**
            * Show the form for creating a new resource.
            *
            * @return Response
            */
        public function create()
        {
            //
        }
    
        /**
            * Store a newly created resource in storage.
            *
            * @return Response
            */
        public function store(Request $request)
        {
            //
            $reqDate = $request['date_due'];
            $date = date('Y-m-d H:i:s', strtotime($reqDate));
            //$date = date_format($reqDate,"Y-m-d H:i:s");
            $todo = Todo::create(
                [
                    'name' => $request['name'],
                    'date_due' => $date,
                ]
            );


            return redirect('/todo');
        }
    
        /**
            * Display the specified resource.
            *
            * @param  int  $id
            * @return Response
            */
        public function show($id)
        {
            //
        }
    
        /**
            * Show the form for editing the specified resource.
            *
            * @param  int  $id
            * @return Response
            */
        public function edit($id)
        {
            $todos = Todo::all();

            $edit = Todo::where('id',$id)->get()->first();
            $edit->month = date('m', strtotime($edit->date_due));
            $edit->day = date('d', strtotime($edit->date_due));
            $edit->year = date('Y', strtotime($edit->date_due));

            return view('edit')->with(compact('todos'))->with('edit',$edit);
        }
    
        /**
            * Update the specified resource in storage.
            *
            * @param  int  $id
            * @return Response
            */
        public function update($id, Request $request)
        {
            //
            $reqDate = $request['date_due'];
            $date = date('Y-m-d H:i:s', strtotime($reqDate));
            //$date = date_format($reqDate,"Y-m-d H:i:s");
            $todo=Todo::where('id',$id)->get()->first();

            $todo->update(
                [
                    'name' => $request['name'],
                    'date_due' => $date,
                ]
            );


            return redirect('/todo');
        }
    
        /**
            * Remove the specified resource from storage.
            *
            * @param  int  $id
            * @return Response
            */
        public function destroy($id)
        {
            //
            $todo=Todo::where('id',$id)->delete();

            return redirect('/todo');
        }

        public function complete($id)
        {
            $todo=Todo::where('id',$id)->get()->first();
            if ( $todo->completed == 0 ) {
                $todo->update(['completed'=>1]);
            } else {
                $todo->update(['completed'=>0]);
            }

            return;
        }
    
}
