<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long id long access_hash bytes file_reference int date Vector<PhotoSize> sizes int dc_id true has_stickers Vector<VideoSize> video_sizes
 * @return Photo
 */

final class Photo extends Instance {
	public function request(int $id,int $access_hash,string $file_reference,int $date,array $sizes,int $dc_id,? true $has_stickers = null,? array $video_sizes = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xfb197a65);
		$flags = 0;
		$flags |= is_null($has_stickers) ? 0 : (1 << 0);
		$flags |= is_null($video_sizes) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->writeLong($id);
		$writer->writeLong($access_hash);
		$writer->tgwriteBytes($file_reference);
		$writer->writeInt($date);
		$writer->tgwriteVector($sizes,'PhotoSize');
		if(is_null($video_sizes) === false):
			$writer->tgwriteVector($video_sizes,'VideoSize');
		endif;
		$writer->writeInt($dc_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['has_stickers'] = true;
		else:
			$result['has_stickers'] = false;
		endif;
		$result['id'] = $reader->readLong();
		$result['access_hash'] = $reader->readLong();
		$result['file_reference'] = $reader->tgreadBytes();
		$result['date'] = $reader->readInt();
		$result['sizes'] = $reader->tgreadVector('PhotoSize');
		if($flags & (1 << 1)):
			$result['video_sizes'] = $reader->tgreadVector('VideoSize');
		else:
			$result['video_sizes'] = null;
		endif;
		$result['dc_id'] = $reader->readInt();
		return new self($result);
	}
}

?>