<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FooterMenuDataTable;
use App\Http\Controllers\Controller;
use App\Models\FooterMenu;
use App\Models\FooterTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FooterMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FooterMenuDataTable $dataTable)
    {
        $footerTitle = FooterTitle::first();
        return $dataTable->render('admin.footer.footer-menu.index', compact('footerTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.footer.footer-menu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'url' => ['required', 'url'],
            'status' => ['required']
        ]);

        $footer = new FooterMenu();
        $footer->name = $request->name;
        $footer->url = $request->url;
        $footer->status = $request->status;
        $footer->save();

        Cache::forget('footer_menu');

        toastr('Created Successfully!', 'success', 'success');

        return redirect()->route('admin.footer-menu.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $footer = FooterMenu::findOrFail($id);
        return view('admin.footer.footer-menu.edit', compact('footer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'url' => ['required', 'url'],
            'status' => ['required']
        ]);

        $footer = FooterMenu::findOrFail($id);
        $footer->name = $request->name;
        $footer->url = $request->url;
        $footer->status = $request->status;
        $footer->save();

        Cache::forget('footer_menu');

        toastr('Update Successfully!', 'success', 'success');

        return redirect()->route('admin.footer-menu.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $footer = FooterMenu::findOrFail($id);
        $footer->delete();
        Cache::forget('footer_menu');

        return response(['status' => 'success', 'message' => 'Deleted successfully!']);
    }

    public function changeStatus(Request $request)
    {
        $footer = FooterMenu::findOrFail($request->id);
        $footer->status = $request->status == 'true' ? 1 : 0;
        $footer->save();
        
        Cache::forget('footer_menu');

        return response(['message' => 'Status has been updated!']);
    }

    public function changeTitle(Request $request)
    {
       $request->validate([
        'title' => ['required', 'max:200']
       ]);

       FooterTitle::updateOrCreate(
        ['id' => 1],
        ['footer_menu_title' => $request->title]
       );

       toastr('Updated Successfully', 'success', 'success');

       return redirect()->back();
    }
}
