<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long hash Vector<EmojiStatus> statuses
 * @return account.EmojiStatuses
 */

final class EmojiStatuses extends Instance {
	public function request(int $hash,array $statuses) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x90c467d1);
		$writer->writeLong($hash);
		$writer->tgwriteVector($statuses,'EmojiStatus');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['hash'] = $reader->readLong();
		$result['statuses'] = $reader->tgreadVector('EmojiStatus');
		return new self($result);
	}
}

?>