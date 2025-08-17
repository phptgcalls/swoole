<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Secret;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long id long access_hash int date string mime_type int size photosize thumb int dc_id Vector<DocumentAttribute> attributes
 * @return secret.DecryptedMessageMedia
 */

final class DecryptedMessageMediaExternalDocument extends Instance {
	public function request(int $id,int $access_hash,int $date,string $mime_type,int $size,object $thumb,int $dc_id,array $attributes) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xfa95b0dd);
		$writer->writeLong($id);
		$writer->writeLong($access_hash);
		$writer->writeInt($date);
		$writer->tgwriteBytes($mime_type);
		$writer->writeInt($size);
		$writer->write($thumb->read());
		$writer->writeInt($dc_id);
		$writer->tgwriteVector($attributes,'DocumentAttribute');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['id'] = $reader->readLong();
		$result['access_hash'] = $reader->readLong();
		$result['date'] = $reader->readInt();
		$result['mime_type'] = $reader->tgreadBytes();
		$result['size'] = $reader->readInt();
		$result['thumb'] = $reader->tgreadObject();
		$result['dc_id'] = $reader->readInt();
		$result['attributes'] = $reader->tgreadVector('DocumentAttribute');
		return new self($result);
	}
}

?>