<div id="newSectionModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('new.section') }}">
      {{ csrf_field() }}
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Select Grade Level</label>
          <select name="level" class="form-control" id="level" required data-parsley-required-message="Please select the year level!" data-parsley-errors-container="#level-error">
            <option selected disabled>--Select Level--</option>
            @foreach($levels as $level)
                @if($level->category == 'G')
                  <option value="{{ $level->id }}">Grade {{ $level->level }}</option>
                @elseif($level->category == 'P')
                  <option value="{{ $level->id }}">{{ $level->level }}</option>
                @elseif($level->category == 'H')
                  <option value="{{ $level->id }}">{{ ordinal($level->level) }} Year</option>
                @endif
              @endforeach
          </select>
        </div>
        <div class="form-group">
          <label>Enter Section Name</label>
          <input type="text" name="section_name" class="form-control" data-toggle="tooltip" title="Please enter only the name of the section. Do not put the word 'Section' before the section name. The system will automatically do it for you.">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
    </div>
    </form>
  </div>
</div>