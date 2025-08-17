<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string q long hash true exclude_featured
 * @return messages.FoundStickerSets
 */

final class SearchStickerSets extends Instance {
	public function request(string $q,int $hash,? true $exclude_featured = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x35705b8a);
		$flags = 0;
		$flags |= is_null($exclude_featured) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($q);
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