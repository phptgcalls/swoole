<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param true nopremium true spoiler true video true round true voice document document Vector<Document> alt_documents photo video_cover int video_timestamp int ttl_seconds
 * @return MessageMedia
 */

final class MessageMediaDocument extends Instance {
	public function request(? true $nopremium = null,? true $spoiler = null,? true $video = null,? true $round = null,? true $voice = null,? object $document = null,? array $alt_documents = null,? object $video_cover = null,? int $video_timestamp = null,? int $ttl_seconds = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x52d8ccd9);
		$flags = 0;
		$flags |= is_null($nopremium) ? 0 : (1 << 3);
		$flags |= is_null($spoiler) ? 0 : (1 << 4);
		$flags |= is_null($video) ? 0 : (1 << 6);
		$flags |= is_null($round) ? 0 : (1 << 7);
		$flags |= is_null($voice) ? 0 : (1 << 8);
		$flags |= is_null($document) ? 0 : (1 << 0);
		$flags |= is_null($alt_documents) ? 0 : (1 << 5);
		$flags |= is_null($video_cover) ? 0 : (1 << 9);
		$flags |= is_null($video_timestamp) ? 0 : (1 << 10);
		$flags |= is_null($ttl_seconds) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		if(is_null($document) === false):
			$writer->write($document->read());
		endif;
		if(is_null($alt_documents) === false):
			$writer->tgwriteVector($alt_documents,'Document');
		endif;
		if(is_null($video_cover) === false):
			$writer->write($video_cover->read());
		endif;
		if(is_null($video_timestamp) === false):
			$writer->writeInt($video_timestamp);
		endif;
		if(is_null($ttl_seconds) === false):
			$writer->writeInt($ttl_seconds);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 3)):
			$result['nopremium'] = true;
		else:
			$result['nopremium'] = false;
		endif;
		if($flags & (1 << 4)):
			$result['spoiler'] = true;
		else:
			$result['spoiler'] = false;
		endif;
		if($flags & (1 << 6)):
			$result['video'] = true;
		else:
			$result['video'] = false;
		endif;
		if($flags & (1 << 7)):
			$result['round'] = true;
		else:
			$result['round'] = false;
		endif;
		if($flags & (1 << 8)):
			$result['voice'] = true;
		else:
			$result['voice'] = false;
		endif;
		if($flags & (1 << 0)):
			$result['document'] = $reader->tgreadObject();
		else:
			$result['document'] = null;
		endif;
		if($flags & (1 << 5)):
			$result['alt_documents'] = $reader->tgreadVector('Document');
		else:
			$result['alt_documents'] = null;
		endif;
		if($flags & (1 << 9)):
			$result['video_cover'] = $reader->tgreadObject();
		else:
			$result['video_cover'] = null;
		endif;
		if($flags & (1 << 10)):
			$result['video_timestamp'] = $reader->readInt();
		else:
			$result['video_timestamp'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['ttl_seconds'] = $reader->readInt();
		else:
			$result['ttl_seconds'] = null;
		endif;
		return new self($result);
	}
}

?>