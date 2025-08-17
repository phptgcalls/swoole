<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long hash Vector<Document> stickers
 * @return messages.Stickers
 */

final class Stickers extends Instance {
	public function request(int $hash,array $stickers) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x30a6ec7e);
		$writer->writeLong($hash);
		$writer->tgwriteVector($stickers,'Document');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['hash'] = $reader->readLong();
		$result['stickers'] = $reader->tgreadVector('Document');
		return new self($result);
	}
}

?>