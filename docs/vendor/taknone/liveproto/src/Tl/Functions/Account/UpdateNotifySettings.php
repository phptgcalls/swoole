<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputnotifypeer peer inputpeernotifysettings settings
 * @return Bool
 */

final class UpdateNotifySettings extends Instance {
	public function request(object $peer,object $settings) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x84be5b93);
		$writer->write($peer->read());
		$writer->write($settings->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>