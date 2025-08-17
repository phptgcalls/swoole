<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long hash
 * @return account.EmojiStatuses
 */

final class GetRecentEmojiStatuses extends Instance {
	public function request(int $hash) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf578105);
		$writer->writeLong($hash);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>