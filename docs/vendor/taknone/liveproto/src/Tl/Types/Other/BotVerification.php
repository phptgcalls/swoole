<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long bot_id long icon string description
 * @return BotVerification
 */

final class BotVerification extends Instance {
	public function request(int $bot_id,int $icon,string $description) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf93cd45c);
		$writer->writeLong($bot_id);
		$writer->writeLong($icon);
		$writer->tgwriteBytes($description);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['bot_id'] = $reader->readLong();
		$result['icon'] = $reader->readLong();
		$result['description'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>