<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param notificationsound sound bool show_previews reactionnotificationsfrom messages_notify_from reactionnotificationsfrom stories_notify_from
 * @return ReactionsNotifySettings
 */

final class ReactionsNotifySettings extends Instance {
	public function request(object $sound,bool $show_previews,? object $messages_notify_from = null,? object $stories_notify_from = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x56e34970);
		$flags = 0;
		$flags |= is_null($messages_notify_from) ? 0 : (1 << 0);
		$flags |= is_null($stories_notify_from) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		if(is_null($messages_notify_from) === false):
			$writer->write($messages_notify_from->read());
		endif;
		if(is_null($stories_notify_from) === false):
			$writer->write($stories_notify_from->read());
		endif;
		$writer->write($sound->read());
		$writer->tgwriteBool($show_previews);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['messages_notify_from'] = $reader->tgreadObject();
		else:
			$result['messages_notify_from'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['stories_notify_from'] = $reader->tgreadObject();
		else:
			$result['stories_notify_from'] = null;
		endif;
		$result['sound'] = $reader->tgreadObject();
		$result['show_previews'] = $reader->tgreadBool();
		return new self($result);
	}
}

?>