<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;
use Throwable;

class BaseService
{
    /**
     * Delete Or Restore
     *
     * @param $item
     * @param $status
     */
    public function deleteBlockRestore($item, $status): void
    {
        if (! $item->trashed()) {
            if ($status === 'deleted') {
                // Delete Item
                $item->delete();
                $item->update([
                    'deleted_by' => auth()->user()->id,
                    'deleted_at' => now()->format('Y-m-d H:i:s')
                ]);

                notifyMe('success', trans('global.toasts.deleted'));
            } elseif ($status === 'blocked') {
                // Blocked Item
                $item->update([
                    'blocked_by' => auth()->user()->id,
                    'blocked_at' => now()->format('Y-m-d H:i:s')
                ]);

                notifyMe('success', trans('global.toasts.info_is_blocked'));
            }
        } else {
            if ($status === 'active') {
                // Restore Item
                $item->restore();

                notifyMe('success', trans('global.toasts.restore'));
            }
        }
    }

    /**
     * Redirect To
     *
     * @param Request $request
     * @param $routeTo
     * @return RedirectResponse
     */
    public function redirectTo(Request $request, $routeTo): RedirectResponse
    {
        /*
         * CREATE
         */
        // Create
        if ($request->has('create') && $request->get('create') !== '') {
            return redirect()->back();
        }

        // Create and Edit
        if ($request->has('create_and_exit') && $request->get('create_and_exit') !== '') {
            return redirect()->route($routeTo->index);
        }

        /*
         * UPDATE
         */
        // Save
        if ($request->has('save') && $request->get('save') !== '') {
            return redirect()->back();
        }

        // Save and Exit
        if ($request->has('save_and_exit') && $request->get('save_and_exit') !== '' && route_exists($routeTo->index)) {
            return redirect()->route($routeTo->index);
        }

        // Save and Exit
        if ($request->has('change_password') && $request->get('change_password') !== '' && route_exists($routeTo->index)) {
            return redirect()->route($routeTo->index);
        }

        // Save and New
        if ($request->has('save_and_new') && $request->get('save_and_new') !== '' && route_exists($routeTo->create)) {
            return redirect()->route($routeTo->create);
        }

        return redirect()->back();
    }

    /**
     * Process Image
     *
     * @param UploadedFile $image_upload
     * @param string $folder
     * @return string
     */
    public function processImage(UploadedFile $image_upload, $folder = ''): string
    {
        // File name
        $fileName       = slug(str_replace('.' . $image_upload->getClientOriginalExtension(), '', $image_upload->getClientOriginalName()));

        // File manipulation
        $imageName      = $fileName . time() . '.' . $image_upload->getClientOriginalExtension();

        // Image paths
        $thumbnail      = public_path() . '/' . config('app_invoice.common.thumbnail_path');
        $image          = public_path() . '/' . config('app_invoice.common.cover_path');

        if ($folder !== '') {
            $thumbnail      = public_path() . '/img/' . $folder . '/thumbnails';
            $image          = public_path() . '/img/' . $folder . '/covers';
        }

        folder_exists($thumbnail);
        folder_exists($image);

        // Thumbnail image
        $resize_image   = Image::make($image_upload->getRealPath());
        $resize_image->resize(150, 150, static function ($constraint) {
            $constraint->aspectRatio();
        })->save($thumbnail . '/' . $imageName);

        // Normal image
        $image_upload->move($image, $imageName);

        return config('app_invoice.common.thumbnail_path') . '/' . $imageName;
    }

    /**
     * Get IdentificationType from String
     *
     * @param string $id
     * @return string
     */
    public function getIdentificationType(string $id): string
    {
        if ($id === 'cedula') {
            $typeIdentification = 'C';
        } elseif ($id === 'ruc') {
            $typeIdentification = 'R';
        } else {
            $typeIdentification = 'P';
        }

        return $typeIdentification;
    }

    /**
     * Base: Ajax Request
     *
     * @param Model $item
     * @param $view
     * @param $routeTo
     * @return JsonResponse|RedirectResponse
     */
    public function ajax(Model $item, $view, $routeTo)
    {
        if ($item === null) {
            notifyMe('warning', trans('global.toasts.no_data'));
            return redirect()->route($routeTo);
        }

        if (request()->ajax()) {
            try {
                $html = view($view, ['item' => $item])->render();
                return response()->json(['content' => $html]);
            } catch (Throwable $e) {
                Log::error('Ajax error in ' . __CLASS__ . '::' . __FUNCTION__, ['item' => $item]);
                return response()->json(['content' => $item]);
            }
        }

        return redirect()->route($routeTo);
    }
}
