<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckExcelFile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($request->hasFile('file') && ($request->file('file')->getClientOriginalExtension() == 'xlsx' || $request->file('file')->getClientOriginalExtension() == 'xls' || $request->file('file')->getClientOriginalExtension() == 'csv' || $request->file('file')->getClientOriginalExtension() == 'ods')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $file->move('public/uploads/excel', $fileName);

            return $response;
        }

        return back()->with('error', __('The file must be in the following formats: xlsx, xls, csv, ods!'));
    }
}
