<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $todo = Todo::all();
        return view('Home')->with(compact('todo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // $data = $this->validate($request,Todo::rules(),Todo::messages());
        $data = Validator::make($request->all(),Todo::rules(),Todo::messages());
        if ($data->fails())
        {
            return response()->json(['errors'=>$data->errors()]);
        }
        $new = new Todo();
        $new->title = $request->title;
        $new->description = $request->description;
        $todo =$new->save();
        return response()->json(['success'=>'Data Added Successfully']);

        // return redirect('/')->with('success','Form submit successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $todo = Todo::find($id);
        return response()->json($todo);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $todo = Todo::find($id);
        $validate = Validator::make($request->all(),Todo::rules(),Todo::messages());
        if ($validate->fails())
        {
            return response()->json(['errors'=>$validate->errors()]);
        }
        $todo->title = $request->title;
        $todo->description = $request->description;
        $todo->save();
        return response()->json($todo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $delete = Todo::destroy($id);
        if($delete){
            return response()->json($delete);
        }
    }

    public function search(Request $request){

        if($request->ajax()){
            $data = Todo::where('title','LIKE',$request->title1.'%')->get();
            $output='';
            if (count($data)>0) {

                $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';

                foreach ($data as $row){

                    $output .= '<li class="list-group-item">'.$row->title.'</li>';
                }

                $output .= '</ul>';
            }
            else {

                $output .= '<li class="list-group-item">'.'No results'.'</li>';
            }
            return $output;
        }


    }
}
