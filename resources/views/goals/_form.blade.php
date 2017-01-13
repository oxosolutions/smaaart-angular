<div class="box-body">
  <div class="form-group {{ $errors->has('goal_number') ? ' has-error' : '' }}">
    {!!Form::label('goal_number','Goal Number') !!}
    {!!Form::text('goal_number',null, ['class'=>'form-control','placeholder'=>'Enter Goal Number']) !!}
    @if($errors->has('goal_number'))
      <span class="help-block">
            {{ $errors->first('goal_number') }}
      </span>
    @endif
  </div>

  <div class="form-group {{ $errors->has('goal_title') ? ' has-error' : '' }}">
    {!!Form::label('goal_title','Goal Title') !!}
    {!!Form::text('goal_title',null, ['class'=>'form-control','placeholder'=>'Enter Goal Title']) !!}
    @if($errors->has('goal_title'))
      <span class="help-block">
            {{ $errors->first('goal_title') }}
      </span>
    @endif
  </div>

  <div class="form-group {{ $errors->has('goal_tagline') ? ' has-error' : '' }}">
    {!!Form::label('goal_tagline','Goal Tagline') !!}
    {!!Form::text('goal_tagline',null, ['class'=>'form-control','placeholder'=>'Enter Goal Tagline']) !!}
    @if($errors->has('goal_tagline'))
      <span class="help-block">
            {{ $errors->first('goal_tagline') }}
      </span>
    @endif
  </div>

  <div class="form-group {{ $errors->has('goal_description') ? ' has-error' : '' }}">
    {!!Form::label('goal_description','Description') !!}
    {!!Form::textarea('goal_description',null,['class'=>'form-control','placeholder'=>'Enter Description','id'=>'goal_description']) !!}
    @if($errors->has('goal_description'))
      <span class="help-block">
            {{ $errors->first('goal_description') }}
      </span>
    @endif
  </div>

  <div class="{{ $errors->has('goal_url') ? ' has-error' : '' }} form-group">
    {!!Form::label('goal_url','Goal URL') !!}
    {!!Form::text('goal_url',null, ['class'=>'form-control','placeholder'=>'Enter Goal URL']) !!}
    @if($errors->has('goal_url'))
      <span class="help-block">
            {{ $errors->first('goal_url') }}
      </span>
    @endif
  </div>

  <div class="{{ $errors->has('goal_icon') ? ' has-error' : '' }} form-group">
    {!!Form::label('goal_icon','Goal Icon') !!}
    {!!Form::text('goal_icon',null, ['class'=>'form-control','placeholder'=>'Enter Goal Icon']) !!}
    @if($errors->has('goal_icon'))
      <span class="help-block">
            {{ $errors->first('goal_icon') }}
      </span>
    @endif
  </div>

  <div class="{{ $errors->has('goal_icon_url') ? ' has-error' : '' }} form-group">
    {!!Form::label('goal_icon_url','Goal Icon URL') !!}
    {!!Form::text('goal_icon_url',null, ['class'=>'form-control','placeholder'=>'Enter Goal Icon URL']) !!}
    @if($errors->has('goal_icon_url'))
      <span class="help-block">
            {{ $errors->first('goal_icon_url') }}
      </span>
    @endif
  </div>

  <div class="{{ $errors->has('goal_color_hex') ? ' has-error' : '' }} form-group">
    {!!Form::label('goal_color_hex','Goal Color Hex') !!}
    {!!Form::text('goal_color_hex',null, ['class'=>'form-control','placeholder'=>'Enter Goal Color']) !!}
    @if($errors->has('goal_color_hex'))
      <span class="help-block">
            {{ $errors->first('goal_color_hex') }}
      </span>
    @endif
  </div>

   <div class="{{ $errors->has('goal_color_rgb') ? ' has-error' : '' }} form-group">
    {!!Form::label('goal_color_rgb','Goal Color RGB') !!}
    {!!Form::text('goal_color_rgb',null, ['class'=>'form-control','placeholder'=>'Enter Goal Color RGB']) !!}
    @if($errors->has('goal_color_rgb'))
      <span class="help-block">
            {{ $errors->first('goal_color_rgb') }}
      </span>
    @endif
  </div>

   <div class="{{ $errors->has('goal_color_rgb_a') ? ' has-error' : '' }} form-group">
    {!!Form::label('goal_color_rgb_a','Goal Color RGBA') !!}
    {!!Form::text('goal_color_rgb_a',null, ['class'=>'form-control','placeholder'=>'Enter Goal Color RGB A']) !!}
    @if($errors->has('goal_color_rgb_a'))
      <span class="help-block">
            {{ $errors->first('goal_color_rgb_a') }}
      </span>
    @endif
  </div>



  <div class="{{ $errors->has('goal_opacity') ? ' has-error' : '' }} form-group">
    {!!Form::label('goal_opacity','Goal Opacity') !!}
    {!!Form::text('goal_opacity',null, ['class'=>'form-control','placeholder'=>'Enter Goal Opacity']) !!}
    @if($errors->has('goal_opacity'))
      <span class="help-block">
            {{ $errors->first('goal_opacity') }}
      </span>
    @endif
  </div>


  <div class="{{ $errors->has('goal_nodal_ministry') ? ' has-error' : '' }} form-group">
    {!!Form::label('goal_nodal_ministry','Goal Nodal Ministry') !!}
    {!!Form::select('goal_nodal_ministry',\App\Ministrie::ministryList(),null, ['class'=>'form-control', 'placeholder'=>'Select Goal Nodal Ministry']) !!}
    @if($errors->has('goal_nodal_ministry'))
      <span class="help-block">
            {{ $errors->first('goal_nodal_ministry') }}
      </span>
    @endif
  </div>

  <div class="{{ $errors->has('goal_other_ministries') ? ' has-error' : '' }} form-group">
    {!!Form::label('goal_other_ministries','Goal Other Ministry') !!}
    {!!Form::select('goal_other_ministries[]',\App\Ministrie::ministryList(),@$minis, ['class'=>'form-control select2','multiple']) !!}
    @if($errors->has('goal_other_ministries'))
      <span class="help-block">
            {{ $errors->first('goal_other_ministries') }}
      </span>
    @endif
  </div>


  <div class="{{ $errors->has('goal_schemes') ? ' has-error' : '' }} form-group">
    {!!Form::label('goal_schemes','Goal Schemes') !!}
    {!!Form::select('goal_schemes[]',\App\GoalsSchema::schemaList(),@$schema, ['class'=>'form-control select2','multiple']) !!}
  @if($errors->has('goal_schemes'))
      <span class="help-block">
            {{ $errors->first('goal_schemes') }}
      </span>
    @endif
  </div>

  <div class="{{ $errors->has('goal_interventions') ? ' has-error' : '' }} form-group">
    {!!Form::label('goal_interventions','Goal Intervations') !!}
        {!!Form::select('goal_interventions[]',\App\GoalsIntervention::interventionList(),@$intervention, ['class'=>'form-control select2','multiple']) !!}

    @if($errors->has('goal_interventions'))
      <span class="help-block">
            {{ $errors->first('goal_interventions') }}
      </span>
    @endif
  </div>

  <div class="{{ $errors->has('goal_targets') ? ' has-error' : '' }} form-group">
    {!!Form::label('goal_targets','Goal Targets') !!}
        {!!Form::select('goal_targets[]',\App\GoalsTarget::targetList(),@$target, ['class'=>'form-control select2','multiple']) !!}

    @if($errors->has('goal_targets'))
      <span class="help-block">
            {{ $errors->first('goal_targets') }}
      </span>
    @endif
  </div>

  <div class="{{ $errors->has('goal_resources') ? ' has-error' : '' }} form-group">
    {!!Form::label('goal_resources','Goal Resources') !!}
        {!!Form::select('goal_resources[]',\App\GoalsResource::resourceList(),@$resources, ['class'=>'form-control select2','multiple']) !!}

    @if($errors->has('goal_resources'))
      <span class="help-block">
            {{ $errors->first('goal_resources') }}
      </span>
    @endif
  </div>

   <div class="{{ $errors->has('goal_fact') ? ' has-error' : '' }} form-group">
    {!!Form::label('goal_fact','Goal Facts') !!}
        {!!Form::select('goal_fact[]',\App\GoalFact::factList(),@$fact, ['class'=>'form-control select2','multiple']) !!}

    @if($errors->has('goal_resources'))
      <span class="help-block">
            {{ $errors->first('goal_resources') }}
      </span>
    @endif
  </div>


</div>

<style type="text/css">
  .file-actions{
      float: right;
  }
  .file-upload-indicator{
     display: none;
  }
  .select2-selection__choice{

      background-color: #3c8dbc !important;
  }
  .select2-selection__choice__remove{

      color: #FFF !important;
  }
</style>

<!-- /.box-body -->
