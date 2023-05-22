<?php

namespace App\Http\Controllers\Admin;

use App\DTO\CreateSupportDTO;
use App\DTO\UpdateSupportDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupport;
use App\Models\Support;
use App\Services\SupportService;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function __construct(
        protected SupportService $service
    ) {}

    //public function index(Support $support)
    public function index(Request $request)
    {
        //$supports = $support->all();
        $supports = $this->service->getAll($request->filter);
        dd($supports);
        return view('admin.supports.index', compact('supports'));
    }

    public function show(string $id)
    {
        /*if (!$support = Support::find($id)) {
            return redirect()->back();
        }*/
        if (!$support = $this->service->findOne($id)) {
            return redirect()->back();
        }
        return view('admin.supports.show', compact('support'));
    }

    public function edit(string $id)
    {
        /*if (!$support = Support::find($id)) {
            return redirect()->back();
        }*/
        if (!$support = $this->service->findOne($id)) {
            return redirect()->back();
        }
        return view('admin.supports.edit', compact('support'));
    }

    public function update(StoreUpdateSupport $request, Support $support, string|int $id)
    {
        /*if (!$support = Support::find($id)) {
            return back();
        }
        $data = $request->all();
        $data['status'] = 'C';
        $support->update($request->validated());*/

        $support = $this->service->update(
            UpdateSupportDTO::makeFromRequest($request)
        );

        if (!$support) {
            return back();
        }
        return redirect()->route('supports.index');
    }

    public function create()
    {
        return view('admin.supports.create');
    }

    public function store(StoreUpdateSupport $request)
    {
        /*$data           = $request->validated();
        $data['status'] = 'A';
        Support::create($data);*/
        $this->service->new(
            CreateSupportDTO::makeFromRequest($request)
        );

        return redirect()->route('supports.index');
    }

    public function destroy(string $id)
    {
       /* if (!$support = Support::find($id)->delete()) {
            return back();
        }*/
        $this->service->delete($id);
        return redirect()->route('supports.index');
    }
}
