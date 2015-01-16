<?php
namespace tejrajs\fullcalendar;

/**
 * This is just an example.
 */
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\JsExpression;

class FullCalendar extends Widget{
	public $config = [];
	public $loading = 'Loading...';
	public $googleCalendar = false;
	private $_hashOptions;
	private $_pluginName = 'fullcalendar';
	public $options = [];
    public function run()
    {
        $this->registerClientScript();

        $this->options['data-plugin-name'] = $this->_pluginName;
        $this->options['data-plugin-options'] = $this->_hashOptions;

        Html::addCssClass($this->options, 'fullcalendar');

        echo '<div id="container_' . $this->options['id'] . '">';
        echo '<div class="fc-loading" style="display: none;">' . $this->loading . '</div>';
        echo Html::tag('div', '', $this->options);
        echo '</div>';
    }

    /**
     * Registers the needed JavaScript.
     */
    public function registerClientScript()
    {
        $options = $this->getClientOptions();
        $this->_hashOptions = $this->_pluginName . '_' . hash('crc32', serialize($options));
        $id = $this->options['id'];
        $view = $this->getView();
        $view->registerJs("var {$this->_hashOptions} = {$options};\nvar calendar_{$this->options['id']};", $view::POS_HEAD);
        $js = "calendar_{$this->options['id']} = jQuery(\"#{$id}\").fullCalendar({$this->_hashOptions});";
        $asset = FullCalendarAsset::register($view);
        if (isset($this->config['lang'])) {
            $asset->language = $this->config['lang'];
        }
        if ($this->googleCalendar) {
            $asset->googleCalendar = $this->googleCalendar;
        }
        $view->registerJs($js);
    }

    /**
     * @return array the options for the text field
     */
    protected function getClientOptions()
    {
        $id = $this->options['id'];

        $options['loading'] = new JsExpression("function(isLoading, view ) {
                $('#container_{$id}').find('.fc-loading').toggle(isLoading);
        }");

        $options = array_merge($options, $this->config);
        return Json::encode($options);
    }
}