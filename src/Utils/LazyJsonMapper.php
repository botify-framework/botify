<?php

namespace Jove\Utils;

use Jove\TelegramAPI;
use Jove\Types\Map\Chat;
use Jove\Types\Map\ChatAdministratorRights;
use Jove\Types\Map\ChatInviteLink;
use Jove\Types\Map\ChatMember;
use Jove\Types\Map\File;
use Jove\Types\Map\MenuButtonCommands;
use Jove\Types\Map\MenuButtonDefault;
use Jove\Types\Map\MenuButtonWebApp;
use Jove\Types\Map\Poll;
use Jove\Types\Map\SentWebAppMessage;
use Jove\Types\Map\StickerSet;
use Jove\Types\Map\UserProfilePhotos;

class LazyJsonMapper extends \LazyJsonMapper\LazyJsonMapper
{
    public bool $ok;

    public TelegramAPI $api;
    private array $responses_map = [
        Update::class => [
            'getupdates'
        ],
        WebhookInfo::class=>[
            'getwebhookinfo'
        ],
        User::class=>[
            'getme'
        ],
        Message::class => [
            'sendmessage',
            'forwardmessage',
            'sendphoto',
            'sendaudio',
            'senddocument',
            'sendvideo',
            'sendanimation',
            'sendvoice',
            'sendvideonote',
            'sendlocation',
            'editmessagelivelocation',
            'stopmessagelivelocation',
            'sendvenue',
            'sendcontact',
            'sendpoll',
            'senddice',
            'editmessagetext',
            'editmessagecaption',
            'editmessagemedia',
            'editmessagereplymarkup',
            'sendsticker',
            'sendinvoice',
            'sendgame',
            'setgamescore',
        ],
        MessageId::class => [
            'copymessage'
        ],
        UserProfilePhotos::class =>[
            'getuserprofilephotos',

        ],
        File::class=>[
            'getfile',
            'uploadstickerfile',
            'createnewstickerset',
            'addstickertoset',
        ],
        ChatInviteLink::class=>[
            'createchatinvitelink',
            'editchatinvitelink',
            'revokechatinvitelink',
        ],
        Chat::class=>[
            'getchat',
        ],
        ChatMember::class=>[
            'getchatmember',
        ],
        MenuButtonCommands::class=>[
            'getchatmenubutton',
        ],
        MenuButtonWebApp::class=>[
            'getchatmenubutton',
        ],
        MenuButtonDefault::class=>[
            'getchatmenubutton',
        ],
        ChatAdministratorRights::class=>[
            'getmydefaultadministratorrights',
        ],
        Poll::class => [
            'stoppoll',
        ],
        StickerSet::class =>[
            'getstickerset',

        ],
        SentWebAppMessage::class=>[
            'answerwebappquery',

        ],
        ,
        'bool'=>[
            'setwebhook',
            'deletewebhook',
            'logout',
            'close',
            'editmessagelivelocation',
            'stopmessagelivelocation',
            'sendchataction',
            'banchatmember',
            'unbanchatmember',
            'restrictchatmember',
            'promotechatmember',
            'setchatadministratorcustomtitle',
            'banchatsenderchat',
            'unbanchatsenderchat',
            'setchatpermissions',
            'approvechatjoinrequest',
            'declinechatjoinrequest',
            'setchatphoto',
            'deletechatphoto',
            'setchattitle',
            'setchatdescription',
            'pinchatmessage',
            'unpinchatmessage',
            'unpinallchatmessages',
            'leavechat',
            'setchatstickerset',
            'deletechatstickerset',
            'answercallbackquery',
            'setmycommands',
            'deletemycommands',
            'setchatmenubutton',
            'setmydefaultadministratorrights',
            'editmessagetext',
            'editmessagecaption',
            'editmessagemedia',
            'editmessagereplymarkup',
            'deletemessage',
            'setstickerpositioninset',
            'deletestickerfromset',
            'setstickersetthumb',
            'answerinlinequery',
            'answershippingquery',
            'answerprecheckoutquery',
            'setpassportdataerrors',
            'setgamescore',


        ],
        'string' => [
            'exportchatinvitelink',
        ],
        'int' =>[
            'getchatmembercount',
        ],
        // 'sendmediagroup',
        // 'getchatadministrators',
        // 'getmycommands',
        // 'getgamehighscores'
    ];
    public function __call(string $name, array $arguments = [])
    {
        static $mapped = (function () {
            $converted = [];
            foreach($this->responses_map as $response => $methods)
                foreach($methods as $method)
                    $converted[strtolower($method)] = $response;
            return $converted;
        })();

        if (isset($arguments[0])) {
            $head = array_shift($arguments);
            $arguments = array_merge($head, $arguments);
        }
        array_unshift($arguments, $name);
        $response = $mapped[strtolower($name)] ?? false;
        return call(function () use ($arguments, $response) {
            $r = yield $this->post(... $arguments);
            return ($r['ok'] && $response) 
            ? (
                in_array(gettype($r['result']), ['bool', 'int','array','string']) 
                    ? $r['result']
                    : new $response($r['result'])
            ) : new FallbackResponse($r);
        });
    }
    public function _init()
    {
        parent::_init();

        $this->api = new TelegramAPI();
        $this->ok = true;
    }

    /**
     * Useful for responses
     *
     * @return bool
     */
    public function isOk(): bool
    {
        return $this->ok;
    }

    /**
     * Alias of isOk
     *
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->isOk();
    }
}