<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<InputStickerSet> stickersets true uninstall true archive true unarchive
 * @return Bool
 */

final class ToggleStickerSets extends Instance {
	public function request(array $stickersets,? true $uninstall = null,? true $archive = null,? true $unarchive = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb5052fea);
		$flags = 0;
		$flags |= is_null($uninstall) ? 0 : (1 << 0);
		$flags |= is_null($archive) ? 0 : (1 << 1);
		$flags |= is_null($unarchive) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->tgwriteVector($stickersets,'InputStickerSet');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>