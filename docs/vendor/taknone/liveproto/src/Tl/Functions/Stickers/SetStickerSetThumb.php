<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Stickers;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputstickerset stickerset inputdocument thumb long thumb_document_id
 * @return messages.StickerSet
 */

final class SetStickerSetThumb extends Instance {
	public function request(object $stickerset,? object $thumb = null,? int $thumb_document_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa76a5392);
		$flags = 0;
		$flags |= is_null($thumb) ? 0 : (1 << 0);
		$flags |= is_null($thumb_document_id) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->write($stickerset->read());
		if(is_null($thumb) === false):
			$writer->write($thumb->read());
		endif;
		if(is_null($thumb_document_id) === false):
			$writer->writeLong($thumb_document_id);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>