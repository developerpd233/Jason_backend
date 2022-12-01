<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyLocationRequest;
use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use App\Models\Location;
use App\Models\QrCode;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class LocationsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('location_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Location::with(['qr_codes'])->select(sprintf('%s.*', (new Location())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'location_show';
                $editGate = 'location_edit';
                $deleteGate = 'location_delete';
                $crudRoutePart = 'locations';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('location', function ($row) {
                return $row->location ? $row->location : '';
            });
            $table->editColumn('qrCodeId', function ($row) {
                // dd($row->qr_codes);
                $labels = [];
                foreach ($row->qr_codes as $qr_code) {
                    $labels[] = sprintf('<a href="'.url("admin/qr-codes/".$qr_code->id).'"><span class="label label-info label-many">%s</span>', $qr_code->qr_Code);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'qrCodeId']);

            return $table->make(true);
        }

        return view('admin.locations.index');
    }

    public function create()
    {
        abort_if(Gate::denies('location_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $qr_codes = QrCode::pluck('qr_code', 'id');

        return view('admin.locations.create', compact('qr_codes'));
    }

    public function store(StoreLocationRequest $request)
    {
        $location = Location::create($request->all());
        $location->qr_codes()->sync($request->input('qr_codes', []));

        return redirect()->route('admin.locations.index');
    }

    public function edit(Location $location)
    {
        abort_if(Gate::denies('location_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $qr_codes = QrCode::pluck('qr_code', 'id');

        $location->load('qr_codes');

        return view('admin.locations.edit', compact('location', 'qr_codes'));
    }

    public function update(UpdateLocationRequest $request, Location $location)
    {
        $location->update($request->all());
        $location->qr_codes()->sync($request->input('qr_codes', []));

        return redirect()->route('admin.locations.index');
    }

    public function show(Location $location)
    {
        abort_if(Gate::denies('location_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $qr=QRCode::where('id',$location->qrCodeId)->first();
        return view('admin.locations.show', compact('location','qr'));
    }

    public function destroy(Location $location)
    {
        abort_if(Gate::denies('location_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $location->delete();

        return back();
    }

    public function massDestroy(MassDestroyLocationRequest $request)
    {
        Location::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
