<?php

namespace App\Controllers;


use App\Controllers\BaseController;
use App\Models\Todo;

class TodoController extends BaseController
{

    public function __construct(){
        $this->todo = new Todo();
    }

    public function index()
    {
        $data['todos'] = $this->todo->orderBy('id', 'DESC')->findall();
        return view('todo/index', $data);
    }

    public function store()
    {
        $request = service('request');
        $todoData = $request->getPost();

        if(isset($todoData['submit'])){
            $validate = $this->validate([
                'task' => 'required',
            ]);
    
            if(!$validate){
                return redirect()->route('/')->withInput()->with('validation',$this->validator); 
            }
            
            $data = [
                'task' => $todoData['task']
            ];

            if ($this->todo->insert($data)) {
                session()->setFlashdata('message', 'Added task successfully!');
                session()->setFlashdata('alert-class', 'alert-success');
                return redirect()->route('/'); 
            } else {
                session()->setFlashdata('message', 'Failed to save task!');
                session()->setFlashdata('alert-class', 'alert-danger');

                return redirect()->route('/')->withInput();
            }
        }
        var_dump($todoData);
        
    }

    public function edit()
    {
        //
    }

    public function update($id=0)
    {
        if($this->todo->find($id)){
            $this->todo->update($id);
            session()->setFlashdata('message', 'Deleted task successfully!');
            session()->setFlashdata('alert-class', 'alert-success');
        } else {
            session()->setFlashdata('message', 'Unable to delete task!');
            session()->setFlashdata('alert-class', 'alert-danger');
        }

        return redirect()->route('/');
    }

    public function toggle_complete($id=0){
        $todoData = $this->todo->find($id);
        if($todoData){
            $data = [
                'task' => $todoData->task,
                'completed' => ($todoData->completed == '1' ? 0 : 1),
            ]; 
            $this->todo->update($id,$data);
            session()->setFlashdata('message', 'Updated task successfully!');
            session()->setFlashdata('alert-class', 'alert-success');
        } else {
            session()->setFlashdata('message', 'Unable to update task!');
            session()->setFlashdata('alert-class', 'alert-danger');
        }

        return redirect()->route('/');
    }

    public function destroy($id=0)
    {
        if($this->todo->find($id)){
            $this->todo->delete($id);
            session()->setFlashdata('message', 'Deleted task successfully!');
            session()->setFlashdata('alert-class', 'alert-success');
        } else {
            session()->setFlashdata('message', 'Unable to delete task!');
            session()->setFlashdata('alert-class', 'alert-danger');
        }

        return redirect()->route('/');
    }
}
