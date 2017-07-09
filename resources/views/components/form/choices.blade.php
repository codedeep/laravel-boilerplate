@foreach($choices as $key => $choice)
    @if(is_string($choice))
        @php($value = $key)
        @php($label = $choice)
    @elseif(is_array($choice))
        @php($value = isset($choice_value) ? $choice[$choice_value] : $key)
        @php($label = isset($choice_label) ? $choice[$choice_label] : $key)
    @else
        @php($value = isset($choice_value) ? $choice->$choice_value : $choice->id)
        @php($label = isset($choice_label) ? $choice->$choice_label : $choice->__toString())
    @endif
    <div class="checkbox">
        @if(isset($choice_tooltip))
            @if(is_string($choice))
                @php($description = $choice)
            @elseif(is_array($choice))
                @php($description = $choice[$choice_tooltip['title']])
            @else
                @php($description = $choice->{$choice_tooltip['title']})
            @endif
            @php($label_attributes = [
                'data-toggle' => 'tooltip',
                'data-placement' => $choice_tooltip['position'],
                'title' => $description
            ])
        @endif
        @if($type === 'checkboxes')
            @php($type = 'checkbox')
        @endif
        @if($type === 'radios')
            @php($type = 'radio')
        @endif
        <label class="custom-control custom-{{ $type }}" {{ Html::attributes(isset($label_attributes) ? $label_attributes : []) }}>

            {{ Form::$type($multiple ? "{$name}[]" : $name, $value, null, array_merge(['class' => 'custom-control-input'], $attributes)) }}
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">{{ trans($label) }}</span>
        </label>
    </div>
@endforeach