<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param reactionsnotifysettings settings
 * @return ReactionsNotifySettings
 */

final class SetReactionsNotifySettings extends Instance {
	public function request(object $settings) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x316ce548);
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