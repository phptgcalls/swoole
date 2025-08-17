<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param notifypeer peer peernotifysettings notify_settings
 * @return Update
 */

final class UpdateNotifySettings extends Instance {
	public function request(object $peer,object $notify_settings) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xbec268ef);
		$writer->write($peer->read());
		$writer->write($notify_settings->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['peer'] = $reader->tgreadObject();
		$result['notify_settings'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>