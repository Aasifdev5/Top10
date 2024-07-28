<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\AboutUsGeneral;
use App\Models\ClientLogo;
use App\Models\InstructorSupport;
use App\Models\OurHistory;
use App\Models\TeamMember;
use App\Models\User;
use App\Traits\General;
use App\Traits\ImageSaveTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AboutUsController extends Controller
{
    use General, ImageSaveTrait;

    public function galleryArea()
    {
        if (Session::has('LoggedIn')) {
            $data['user_session'] = User::where('id', Session::get('LoggedIn'))->first();
            $data['title'] = 'Gallery Area';
            $data['navApplicationSettingParentActiveClass'] = 'mm-active';
            $data['subNavAboutUsSettingsActiveClass'] = 'mm-active';
            $data['subNavGalleryAreaActiveClass'] = 'active';

            $data['aboutUsGeneral'] = AboutUsGeneral::first();


            return view('admin.application_settings.about.gallery-area', $data);
        }
    }

    public function galleryAreaUpdate(Request $request)
    {
        $request->validate([
            'gallery_area_title' => 'required|max:255',
            'gallery_area_subtitle' => 'required',
            'gallery_first_image' => 'mimes:jpg|file|dimensions:min_width=536,min_height=644,max_width=536,max_height=644',
            'gallery_second_image' => 'mimes:jpg|file|dimensions:min_width=536,min_height=309,max_width=536,max_height=309',
            'gallery_third_image' => 'mimes:jpg|file|dimensions:min_width=536,min_height=309,max_width=536,max_height=309'
        ]);

        $about = AboutUsGeneral::first();
        if (!$about) {
            $about = new AboutUsGeneral();
        }

        $about->gallery_area_title = $request->gallery_area_title;
        $about->gallery_area_subtitle = $request->gallery_area_subtitle;


        if ($request->file('gallery_first_image')) {
            $about->gallery_first_image = $this->updateImage('about_us_general', $request->gallery_first_image, $about->gallery_first_image, 'null', 'null');
        }

        if ($request->file('gallery_second_image')) {
            $about->gallery_second_image = $this->updateImage('about_us_general', $request->gallery_second_image, $about->gallery_second_image, 'null', 'null');
        }

        if ($request->file('gallery_third_image')) {
            $about->gallery_third_image = $this->updateImage('about_us_general', $request->gallery_third_image, $about->gallery_third_image, 'null', 'null');
        }

        $about->save();

        return redirect()->back();
    }

    public function ourHistory()
    {
        if (Session::has('LoggedIn')) {
            $data['user_session'] = User::where('id', Session::get('LoggedIn'))->first();
            $data['title'] = 'Our History';
            $data['navApplicationSettingParentActiveClass'] = 'mm-active';
            $data['subNavAboutUsSettingsActiveClass'] = 'mm-active';
            $data['subNavOurHistoryActiveClass'] = 'active';

            $data['aboutUsGeneral'] = AboutUsGeneral::first();
            $data['ourHistories'] = OurHistory::all();

            return view('admin.application_settings.about.our-history', $data);
        }
    }

    public function ourHistoryUpdate(Request $request)
    {
        $about = AboutUsGeneral::first();
        if (!$about) {
            $about = new AboutUsGeneral();
        }

        $about->our_history_title = $request->our_history_title;
        $about->our_history_subtitle = $request->our_history_subtitle;
        $about->save();

        $now = now();
        $notInId = [];
        if ($request['our_histories']) {
            if (count($request['our_histories']) > 0) {
                foreach ($request['our_histories'] as $ourHistory) {
                    if ($ourHistory['year'] || $ourHistory['title'] || $ourHistory['subtitle']) {
                        if (@$ourHistory['id']) {
                            $history = OurHistory::find($ourHistory['id']);
                            $history->updated_at = $now;
                        } else {
                            $history = new OurHistory();
                            $history->updated_at = $now;
                        }
                        $history->year = $ourHistory['year'];
                        $history->title = $ourHistory['title'];
                        $history->subtitle = $ourHistory['subtitle'];
                        $history->save();
                        array_push($notInId, $history->id);
                    }
                }
            }
            OurHistory::whereNotIn('id', $notInId)->delete();
        }

        OurHistory::where('updated_at', '!=', $now)->delete();

        return redirect()->back();
    }

    public function upgradeSkill()
    {
        if (Session::has('LoggedIn')) {
            $data['user_session'] = User::where('id', Session::get('LoggedIn'))->first();
            $data['title'] = 'Upgrade Skill';
            $data['navApplicationSettingParentActiveClass'] = 'mm-active';
            $data['subNavAboutUsSettingsActiveClass'] = 'mm-active';
            $data['subNavUpgradeSkillActiveClass'] = 'active';

            $data['aboutUsGeneral'] = AboutUsGeneral::first();

            return view('admin.application_settings.about.upgrade-skill', $data);
        }
    }

    public function upgradeSkillUpdate(Request $request)
    {
        $request->validate([
            'upgrade_skill_logo' => 'mimes:jpg,jpeg,png|file|dimensions:min_width=505,min_height=540,max_width=505,max_height=540',
        ]);
        $about = AboutUsGeneral::first();
        if (!$about) {
            $about = new AboutUsGeneral();
        }

        if ($request->file('upgrade_skill_logo')) {
            $about->upgrade_skill_logo = $this->updateImage('about_us_general', $request->upgrade_skill_logo, $about->upgrade_skill_logo, 'null', 'null');
        }

        $about->upgrade_skill_title = $request->upgrade_skill_title;
        $about->upgrade_skill_subtitle = $request->upgrade_skill_subtitle;
        $about->upgrade_skill_button_name = $request->upgrade_skill_button_name;
        $about->save();

        return redirect()->back();
    }

    public function teamMember()
    {
        if (Session::has('LoggedIn')) {
            $data['user_session'] = User::where('id', Session::get('LoggedIn'))->first();
            $data['title'] = 'Team Member';
            $data['navApplicationSettingParentActiveClass'] = 'mm-active';
            $data['subNavAboutUsSettingsActiveClass'] = 'mm-active';
            $data['subNavTeamMemberActiveClass'] = 'active';

            $data['aboutUsGeneral'] = AboutUsGeneral::first();
            $data['teamMembers'] = TeamMember::all();

            return view('admin.application_settings.about.team-member', $data);
        }
    }

    public function teamMemberUpdate(Request $request)
    {
        $request->validate([
            'team_member_title' => 'required|max:255',
            'team_member_subtitle' => 'required',
            'team_member_logo' => 'mimes:png|file|dimensions:min_width=70,min_height=70,max_width=70,max_height=70',
        ]);

        $about = AboutUsGeneral::first();
        if (!$about) {
            $about = new AboutUsGeneral();
        }

        if ($request->file('team_member_logo')) {
            $about->team_member_logo = $this->updateImage('about_us_general', $request->team_member_logo, $about->team_member_logo, 'null', 'null');
        }

        $about->team_member_title = $request->team_member_title;
        $about->team_member_subtitle = $request->team_member_subtitle;
        $about->save();

        $now = now();
        if ($request['team_members']) {
            if (count(@$request['team_members']) > 0) {
                foreach ($request['team_members'] as $team_member) {
                    if (@$team_member['name'] || @$team_member['designation']  || @$team_member['image']) {
                        if (@$team_member['id']) {
                            $team = TeamMember::find($team_member['id']);
                            if (@$team_member['image']) {
                                $team->image = $this->updateImage('team_member', @$team_member['image'], $team->image, 'null', 'null');
                            }
                        } else {
                            $team = new TeamMember();
                            if (@$team_member['image']) {
                                $team->image = $this->saveImage('team_member', @$team_member['image'], 'null', 'null');
                            }
                        }
                        $team->updated_at = $now;
                        $team->name = @$team_member['name'];
                        $team->designation = @$team_member['designation'];
                        $team->save();
                    }
                }
            }
        }

        TeamMember::where('updated_at', '!=', $now)->get()->map(function ($q) {
            $this->deleteFile($q->image);
            $q->delete();
        });

        return redirect()->back();
    }




    public function client()
    {
        if (Session::has('LoggedIn')) {
            $data['user_session'] = User::where('id', Session::get('LoggedIn'))->first();
            $data['title'] = 'Client';
            $data['navApplicationSettingParentActiveClass'] = 'mm-active';
            $data['subNavAboutUsSettingsActiveClass'] = 'mm-active';
            $data['subNavClientActiveClass'] = 'active';
            $data['clients'] = ClientLogo::all();

            return view('admin.application_settings.about.client', $data);
        }
    }

    public function clientUpdate(Request $request)
    {
        $now = now();
        if ($request['client_details']) {
            if (count(@$request['client_details']) > 0) {
                foreach ($request['client_details'] as $client_detail) {
                    if (@$client_detail['name'] || @$client_detail['logo']) {
                        if (@$client_detail['id']) {
                            $client_logo = ClientLogo::find($client_detail['id']);
                            if (@$client_detail['logo']) {
                                $client_logo->logo = $this->updateImage('client_logo', @$client_detail['logo'], $client_logo->logo, 'null', 'null');
                            }
                        } else {
                            $client_logo = new ClientLogo();
                            if (@$client_detail['logo']) {
                                $client_logo->logo = $this->saveImage('client_logo', @$client_detail['logo'], 'null', 'null');
                            }
                        }
                        $client_logo->name = @$client_detail['name'];
                        $client_logo->updated_at = $now;
                        $client_logo->save();
                    }
                }
            }
        }

        ClientLogo::where('updated_at', '!=', $now)->get()->map(function ($q) {
            $this->deleteFile($q->logo);
            $q->delete();
        });

        return redirect()->back();
    }
    public function clientDelete(Request $request)
    {

        try {
            $client = ClientLogo::findOrFail($request->id);
            $client->delete();

            return response()->json(['success' => 'Client deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete client'], 500);
        }
    }
    public function memberDelete(Request $request)
    {
        try {
            $member = TeamMember::findOrFail($request->id);
            $member->delete();

            return response()->json(['success' => 'Member deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete member'], 500);
        }
    }
    public function historyDelete(Request $request)
    {
        try {
            $history = OurHistory::findOrFail($request->id);
            $history->delete();

            return response()->json(['success' => 'Our history deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete our history'], 500);
        }
    }
}
