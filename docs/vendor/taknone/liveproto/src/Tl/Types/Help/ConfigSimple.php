<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Help;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int date int expires Vector<AccessPointRule> rules
 * @return help.ConfigSimple
 */

final class ConfigSimple extends Instance {
	public function request(int $date,int $expires,array $rules) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x5a592a6c);
		$writer->writeInt($date);
		$writer->writeInt($expires);
		$writer->tgwriteVector($rules,'AccessPointRule');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['date'] = $reader->readInt();
		$result['expires'] = $reader->readInt();
		$result['rules'] = $reader->tgreadVector('AccessPointRule');
		return new self($result);
	}
}

?>