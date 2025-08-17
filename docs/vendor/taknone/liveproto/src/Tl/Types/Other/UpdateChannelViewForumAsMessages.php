<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long channel_id bool enabled
 * @return Update
 */

final class UpdateChannelViewForumAsMessages extends Instance {
	public function request(int $channel_id,bool $enabled) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x7b68920);
		$writer->writeLong($channel_id);
		$writer->tgwriteBool($enabled);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['channel_id'] = $reader->readLong();
		$result['enabled'] = $reader->tgreadBool();
		return new self($result);
	}
}

?>