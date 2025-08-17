<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer long import_id string file_name inputmedia media
 * @return MessageMedia
 */

final class UploadImportedMedia extends Instance {
	public function request(object $peer,int $import_id,string $file_name,object $media) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x2a862092);
		$writer->write($peer->read());
		$writer->writeLong($import_id);
		$writer->tgwriteBytes($file_name);
		$writer->write($media->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>