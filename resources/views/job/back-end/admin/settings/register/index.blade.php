<div class="wt-tabscontenttitle">
    <h2>{{{ trans('lang.register_form_settings') }}}</h2>
</div>
    {!! Form::open(['url' => 'Job/admin/store/registration-settings', 'class' =>'wt-formtheme wt-userform', 'id'
        =>'registration-setting-form']) !!}
        <div class="wt-location wt-tabsinfo la-formstepone la-formsteps">
            <div class="wt-tabscontenttitle">
                <h2>{{{ trans('lang.registration_step1') }}}</h2>
            </div>
            <div class="wt-settingscontent">
                <div class="wt-description"><p>{{ trans('lang.reg_step_1') }}</p></div>
                <div class="wt-formtheme wt-userform">
                    <div class="form-group">
                        {!! Form::text('registration[0][step1-title]', $reg_one_title, array('class' => 'form-control', 'placeholder' => trans('lang.title'))) !!}
                    </div>
                </div>
            </div>
            <div class="wt-settingscontent">
                <div class="wt-formtheme wt-userform">
                    <div class="form-group">
                        {!! Form::textarea('registration[0][step1-subtitle]', $reg_one_subtitle, array('class' => 'form-control', 'placeholder' => trans('lang.description'))) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="wt-location wt-tabsinfo la-formsteps">
            <div class="wt-tabscontenttitle">
                <h2>{{{ trans('lang.registration_step2') }}}</h2>
            </div>
            <div class="wt-settingscontent">
                <div class="wt-description"><p>{{ trans('lang.reg_step_2') }}</p></div>
                <div class="wt-formtheme wt-userform">
                    <div class="form-group">
                        {!! Form::text('registration[0][step2-title]', $reg_two_title, array('class' => 'form-control', 'placeholder' => trans('lang.title'))) !!}
                    </div>
                </div>
            </div>
            <div class="wt-settingscontent">
                <div class="wt-formtheme wt-userform">
                    <div class="form-group">
                        {!! Form::textarea('registration[0][step2-subtitle]', $reg_two_subtitle, array('class' => 'form-control', 'placeholder' => trans('lang.description'))) !!}
                    </div>
                </div>
            </div>
            <div class="wt-settingscontent">
                <div class="wt-formtheme wt-userform">
                    <div class="form-group">
                        {!! Form::textarea('registration[0][step2-term-note]', $term_note, array('class' => 'form-control', 'placeholder' => trans('lang.term_note'))) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="wt-location wt-tabsinfo la-formsteps">
            <div class="wt-tabscontenttitle">
                <h2>{{{ trans('lang.registration_step3') }}}</h2>
            </div>
            <div class="wt-settingscontent">
                <div class="wt-description"><p>{{ trans('lang.reg_step_3') }}</p></div>
                <div class="wt-formtheme wt-userform">
                    <div class="form-group">
                        {!! Form::text('registration[0][step3-title]', $reg_three_title, array('class' => 'form-control', 'placeholder' => trans('lang.title'))) !!}
                    </div>
                </div>
            </div>
            <div class="wt-settingscontent">
                <div class="wt-formtheme wt-userform">
                    <div class="form-group">
                        {!! Form::textarea('registration[0][step3-subtitle]', $reg_three_subtitle, array('class' => 'form-control', 'placeholder' => trans('lang.description'))) !!}
                    </div>
                </div>
            </div>
            <div class="wt-settingscontent la-footer-settings">
                <div class="wt-formtheme wt-userform">
                    <div class="form-group">
                        <span class="wt-select">
                            {!! Form::select('registration[0][step3-page]', $pages, $reg_page, array('class' => '', 'placeholder' => trans('lang.select_pages'))) !!}
                        </span>
                    </div>
                </div>
            </div>
            @include('job.back-end.admin.settings.register.image')
        </div>
        <div class="wt-location wt-tabsinfo la-formsteps">
            <div class="wt-tabscontenttitle">
                <h2>{{{ trans('lang.registration_step4') }}}</h2>
            </div>
            <div class="wt-settingscontent">
                <div class="wt-description"><p>{{ trans('lang.reg_step_4') }}</p></div>
                <div class="wt-formtheme wt-userform">
                    <div class="form-group">
                        {!! Form::text('registration[0][step4-title]', $reg_four_title, array('class' => 'form-control', 'placeholder' => trans('lang.title'))) !!}
                    </div>
                </div>
            </div>
            <div class="wt-settingscontent">
                <div class="wt-formtheme wt-userform">
                    <div class="form-group">
                        {!! Form::textarea('registration[0][step4-subtitle]', $reg_four_subtitle, array('class' => 'form-control', 'placeholder' => trans('lang.description'))) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="wt-updatall la-updateall-holder">
            {!! Form::submit(trans('lang.btn_save'), ['class' => 'wt-btn']) !!}
        </div>
    {!! Form::close() !!}
