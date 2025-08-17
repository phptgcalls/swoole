<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<StickerSetCovered> sets
 * @return messages.StickerSetInstallResult
 */

final class StickerSetInstallResultArchive extends Instance {
	public function request(array $sets) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x35e410a8);
		$writer->tgwriteVector($sets,'StickerSetCovered');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['sets'] = $reader->tgreadVector('StickerSetCovered');
		return new self($result);
	}
}

?>