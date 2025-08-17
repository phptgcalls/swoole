<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Help;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<Timezone> timezones int hash
 * @return help.TimezonesList
 */

final class TimezonesList extends Instance {
	public function request(array $timezones,int $hash) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x7b74ed71);
		$writer->tgwriteVector($timezones,'Timezone');
		$writer->writeInt($hash);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['timezones'] = $reader->tgreadVector('Timezone');
		$result['hash'] = $reader->readInt();
		return new self($result);
	}
}

?>