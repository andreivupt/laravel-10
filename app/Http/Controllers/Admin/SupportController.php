<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupport;
use App\Models\Support;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index(Support $support)
    {
        $supports = $support->all();
        return view('admin.supports.index', compact('supports'));
    }

    public function show(string|int $id)
    {
        if (!$support = Support::find($id)) {
            return redirect()->back();
        }
        return view('admin.supports.show', compact('support'));
    }

    public function edit(string|int $id)
    {
        if (!$support = Support::find($id)) {
            return redirect()->back();
        }
        return view('admin.supports.edit', compact('support'));
    }

    public function update(Request $request, Support $support, string|int $id)
    {
        if (!$support = Support::find($id)) {
            return back();
        }

        $data = $request->all();
        $data['status'] = 'C';

        $support->update($data);
        return redirect()->route('supports.index');
    }

    public function create()
    {
        return view('admin.supports.create');
    }

    public function store(StoreUpdateSupport $storeSupport,Request $request)
    {
        $data           = $request->all();
        $data['status'] = 'A';

        Support::create($data);

        return redirect()->route('supports.index');
    }

    public function destroy(string|int $id)
    {
        if (!$support = Support::find($id)->delete()) {
            return back();
        }
        return redirect()->route('supports.index');
    }
}
