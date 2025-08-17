<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long hash Vector<Document> gifs
 * @return messages.SavedGifs
 */

final class SavedGifs extends Instance {
	public function request(int $hash,array $gifs) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x84a02a0d);
		$writer->writeLong($hash);
		$writer->tgwriteVector($gifs,'Document');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['hash'] = $reader->readLong();
		$result['gifs'] = $reader->tgreadVector('Document');
		return new self($result);
	}
}

?>