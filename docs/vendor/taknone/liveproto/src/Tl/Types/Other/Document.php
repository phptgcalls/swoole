<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long id long access_hash bytes file_reference int date string mime_type long size int dc_id Vector<DocumentAttribute> attributes Vector<PhotoSize> thumbs Vector<VideoSize> video_thumbs
 * @return Document
 */

final class Document extends Instance {
	public function request(int $id,int $access_hash,string $file_reference,int $date,string $mime_type,int $size,int $dc_id,array $attributes,? array $thumbs = null,? array $video_thumbs = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8fd4c4d8);
		$flags = 0;
		$flags |= is_null($thumbs) ? 0 : (1 << 0);
		$flags |= is_null($video_thumbs) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->writeLong($id);
		$writer->writeLong($access_hash);
		$writer->tgwriteBytes($file_reference);
		$writer->writeInt($date);
		$writer->tgwriteBytes($mime_type);
		$writer->writeLong($size);
		if(is_null($thumbs) === false):
			$writer->tgwriteVector($thumbs,'PhotoSize');
		endif;
		if(is_null($video_thumbs) === false):
			$writer->tgwriteVector($video_thumbs,'VideoSize');
		endif;
		$writer->writeInt($dc_id);
		$writer->tgwriteVector($attributes,'DocumentAttribute');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['id'] = $reader->readLong();
		$result['access_hash'] = $reader->readLong();
		$result['file_reference'] = $reader->tgreadBytes();
		$result['date'] = $reader->readInt();
		$result['mime_type'] = $reader->tgreadBytes();
		$result['size'] = $reader->readLong();
		if($flags & (1 << 0)):
			$result['thumbs'] = $reader->tgreadVector('PhotoSize');
		else:
			$result['thumbs'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['video_thumbs'] = $reader->tgreadVector('VideoSize');
		else:
			$result['video_thumbs'] = null;
		endif;
		$result['dc_id'] = $reader->readInt();
		$result['attributes'] = $reader->tgreadVector('DocumentAttribute');
		return new self($result);
	}
}

?>