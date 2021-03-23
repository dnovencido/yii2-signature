<?php

namespace inquid\signature;

/**
 * This is just an example.
 */
class SignatureWidget extends \yii\base\Widget
{
    public $url;
    public $width;
    public $height;
    public $save_png;
    public $save_jpg;
    public $save_svg;
    public $save_server;
    public $clear;
    public $change_color;
    public $undo;
    public $description;
    private $save_buttons;
    private $action_buttons;

    public function init()
    {
        if ($this->width === null)
            $this->width = '500px';
        if ($this->height === null)
            $this->height = '300px';
        if ($this->save_png == true) {
            $this->save_buttons .= '<button type="button" class="button btn-secondary btn-sm float-left save" data-action="save-png">Save as PNG</button>';
        }
        if ($this->save_jpg == true) {
            $this->save_buttons .= '<button type="button" class="button btn-secondary btn-sm float-left save" data-action="save-jpg">Save as JPG</button>';
        }
        if ($this->save_svg == true) {
            $this->save_buttons .= '<button type="button" class="button btn-secondary btn-sm float-left save" data-action="save-svg">Save as SVG</button>';
        }
        if ($this->save_server == true) {
            $this->save_buttons .= '<button type="button" class="button btn btn-success btn-sm float-right save" data-action="save-server" onclick="saveToServer(\'' . $this->url . '\')"><i class="fas fa-save"></i> Save</button>';
        }
        if ($this->clear == true) {
            $this->action_buttons .= '<button type="button" class="button btn btn-secondary btn-sm mr-1 float-left clear" data-action="clear"> <i class="fas fa-eraser"></i> Clear</button>';
        }
        if ($this->change_color == true) {
            $this->action_buttons .= '<button type="button" class="button btn btn-secondary btn-sm mr-1 float-left" data-action="change-color">Change color</button>';
        }
        if ($this->undo == true) {
            $this->action_buttons .= '<button type="button" class="button btn btn-secondary btn-sm float-left" data-action="undo"> <i class="fas fa-undo-alt"></i> Undo</button>';
        }
        SignatureAsset::register($this->view);
    }

    public function run()
    {
        $signature = '
        <style>
        canvas{
            width: ' . $this->width . ';
            height: ' . $this->height . ';
        }
        </style>
         <div id="signature-pad" class="signature-pad">
            <div class="signature-pad--body">
                <canvas></canvas>
            </div>
            <div class="signature-pad--footer">
                <div class="description">' . $this->description . '</div>

                <div class="signature-pad--actions">
                    <div>
                        ' . $this->action_buttons . '
                    </div>
                    <div>
                    ' . $this->save_buttons . '
                    </div>
                </div>
            </div>
        </div>';
        return $signature;
    }
}
