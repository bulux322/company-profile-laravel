<?php

namespace App\Http\Controllers\Backend\Utilities;

use App\Http\Controllers\Controller;
use App\Models\Backend\Utilities\Navigation;
use App\Models\Backend\Utilities\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FooterController extends Controller
{
    /* Social Media */
    public function socialMedia()
    {
        $title = 'Social Media';
        $socialMedia = SocialMedia::latest()->paginate(10)->withQueryString();

        return view('backend.utilities.footer.social-media.index', compact('title', 'socialMedia'));
    }

    public function socialMediaStore(Request $request)
    {
        $rule = [
            'name' => ['required'],
            'icon' => ['required'],
            'url' => ['required'],
            'description' => ['nullable'],
        ];

        $validatedData = $request->validate($rule);

        DB::beginTransaction();
        try {
            SocialMedia::create($validatedData);

            DB::commit();

            return redirect(route('footer.social-media.index'))->with('success', 'Success!');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Error : ' . $th->getMessage());
        }
    }

    public function socialMediaUpdate(SocialMedia $socialMedia, Request $request)
    {
        $rule = [
            'name' => ['required'],
            'icon' => ['required'],
            'url' => ['required'],
            'description' => ['nullable'],
        ];

        $validatedData = $request->validate($rule);

        DB::beginTransaction();
        try {
            SocialMedia::where('id', $socialMedia->id)->update($validatedData);

            DB::commit();

            return redirect(route('footer.social-media.index'))->with('success', 'Success!');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Error : ' . $th->getMessage());
        }
    }

    public function socialMediaDestroy(SocialMedia $socialMedia)
    {
        SocialMedia::destroy($socialMedia->id);

        return redirect(route('footer.social-media.index'))->with('success', 'Success!');
    }

    /* Navigation */
    public function navigation()
    {
        $title = 'Navigation';
        $navigation = Navigation::latest()->paginate(10)->withQueryString();

        return view('backend.utilities.footer.navigation.index', compact('title', 'navigation'));
    }

    public function navigationStore(Request $request)
    {
        $rule = [
            'name' => ['required'],
            'url' => ['required'],
            'description' => ['nullable'],
        ];

        $validatedData = $request->validate($rule);

        DB::beginTransaction();
        try {
            Navigation::create($validatedData);

            DB::commit();

            return redirect(route('footer.navigation.index'))->with('success', 'Success!');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Error : ' . $th->getMessage());
        }
    }

    public function navigationUpdate(Navigation $navigation, Request $request)
    {
        $rule = [
            'name' => ['required'],
            'url' => ['required'],
            'description' => ['nullable'],
        ];

        $validatedData = $request->validate($rule);

        DB::beginTransaction();
        try {
            Navigation::where('id', $navigation->id)->update($validatedData);

            DB::commit();

            return redirect(route('footer.navigation.index'))->with('success', 'Success!');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Error : ' . $th->getMessage());
        }
    }

    public function navigationDestroy(Navigation $navigation)
    {
        Navigation::destroy($navigation->id);

        return redirect(route('footer.navigation.index'))->with('success', 'Success!');
    }
}
