<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long hash Vector<Document> stickers int next_offset
 * @return messages.FoundStickers
 */

final class FoundStickers extends Instance {
	public function request(int $hash,array $stickers,? int $next_offset = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x82c9e290);
		$flags = 0;
		$flags |= is_null($next_offset) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		if(is_null($next_offset) === false):
			$writer->writeInt($next_offset);
		endif;
		$writer->writeLong($hash);
		$writer->tgwriteVector($stickers,'Document');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['next_offset'] = $reader->readInt();
		else:
			$result['next_offset'] = null;
		endif;
		$result['hash'] = $reader->readLong();
		$result['stickers'] = $reader->tgreadVector('Document');
		return new self($result);
	}
}

?>