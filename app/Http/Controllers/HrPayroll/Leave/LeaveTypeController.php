<?php

namespace App\Http\Controllers\HrPayroll\Leave;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\RespondsWithMessage;
use App\Services\HrPayroll\Leave\LeaveService;

class LeaveTypeController extends Controller
{   
    use RespondsWithMessage;

    public $leaveType;

    public function __construct(LeaveService $leaveType)
    {
        $this->leaveType = $leaveType;
    }

    public function index()
    {
        $data['leaveTypes'] = $this->leaveType->allLeaveType();
        return view('hrpayroll.leave.leaveType.index', $data); 
    }

    public function add()
    {
        return view('hrpayroll.leave.leaveType.add');
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:leave_types'
        ]);

        $final = $this->leaveType->saveleaveType($request);
        if ($final) {
            return back()->with('message',
                $this->response(
                    $this->SUCCESSCLASS(),
                    'Leave type added successfully'
                )
            );
        }

        return back()->with('message', 
                $this->response(
                    $this->FAILURECLASS(), 
                    $this->FAILMESSAGE()
                )
            );
            
    }


    public function edit($id)
    {
        $data['leaveType'] = $this->leaveType->getById($id);
        return view('hrpayroll.leave.leaveType.edit', $data);
    }

    public function update($id, Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:leave_types,name,'.$id
        ]);

        $final = $this->leaveType->updateType($request, $id);
        
        if ($final) {
            return back()->with('message',
                $this->response(
                    $this->SUCCESSCLASS(),
                    'Leave type update successfully'
                )
            );
        }

        return back()->with('message', 
                $this->response(
                    $this->FAILURECLASS(), 
                    $this->FAILMESSAGE()
                )
            );
    }

    public function deleteType(Request $request)
    {
        
        $message = '';
        // try {
        //     $this->leaveType->deleteType($request->id);
        // } catch (\Throwable $e) {
        //     // $message = $e->getMessage();
        //     // return $e->getMessage();
        //     return back()->with('message',
        //         $this->response(
        //             $this->SUCCESSCLASS(),
        //             $e->getMessage()
        //         )
        //     );
            
        // }

        return back()->with('message', 'delete');

       
        
        
    }

}
