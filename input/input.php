<?php

class InputField extends BaseField {

  public $type;

  static public $assets = array(
    'js' => array(
      'input.js'
    ),
    'css' => array(
      'input.css'
    )
  );

  public function min() {
    if (isset($this->validate['min'])) {
      return $this->validate['min'];
    }
    return false;
  }

  public function max() {
    if (isset($this->validate['max'])) {
      return $this->validate['max'];
    }
    return false;
  }

  public function input() {

    $input = new Brick('input', null);
    $input->addClass('input');

    if ($this->min() || $this->max()) {
      $input->data('field', 'count')
            ->data('max', $this->max())
            ->data('min', $this->min());
    }

    $input->attr(array(
      'type'         => $this->type(),
      'value'        => '',
      'required'     => $this->required(),
      'name'         => $this->name(),
      'autocomplete' => $this->autocomplete() === false ? 'off' : 'on',
      'autofocus'    => $this->autofocus(),
      'placeholder'  => $this->i18n($this->placeholder()),
      'readonly'     => $this->readonly(),
      'disabled'     => $this->disabled(),
      'id'           => $this->id(),
    ));

    if(!is_array($this->value())) {
      $input->val(html($this->value(), false));
    }

    if($this->readonly()) {
      $input->attr('tabindex', '-1');
      $input->addClass('input-is-readonly');
    }

    return $input;

  }

  public function counter() {

    if(!$this->min() && !$this->max()) return null;

    $counter = new Brick('div');
    $counter->addClass('field-counter marginalia text');

    if (($this->value()->length() < $this->min())
        || ($this->value()->length() > $this->max())) {
      $counter->addClass('outside-range');
    }

    $counter->data('counter', $this->name());

    $counter->html($this->value()->length() . '/' . $this->max());
    return $counter;
  }

  public function template() {

    return $this->element()
      ->append($this->label())
      ->append($this->content())
      ->append($this->counter())
      ->append($this->help());

  }

}