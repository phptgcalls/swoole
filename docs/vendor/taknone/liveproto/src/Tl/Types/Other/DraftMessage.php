<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string message int date true no_webpage true invert_media inputreplyto reply_to Vector<MessageEntity> entities inputmedia media long effect suggestedpost suggested_post
 * @return DraftMessage
 */

final class DraftMessage extends Instance {
	public function request(string $message,int $date,? true $no_webpage = null,? true $invert_media = null,? object $reply_to = null,? array $entities = null,? object $media = null,? int $effect = null,? object $suggested_post = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x96eaa5eb);
		$flags = 0;
		$flags |= is_null($no_webpage) ? 0 : (1 << 1);
		$flags |= is_null($invert_media) ? 0 : (1 << 6);
		$flags |= is_null($reply_to) ? 0 : (1 << 4);
		$flags |= is_null($entities) ? 0 : (1 << 3);
		$flags |= is_null($media) ? 0 : (1 << 5);
		$flags |= is_null($effect) ? 0 : (1 << 7);
		$flags |= is_null($suggested_post) ? 0 : (1 << 8);
		$writer->writeInt($flags);
		if(is_null($reply_to) === false):
			$writer->write($reply_to->read());
		endif;
		$writer->tgwriteBytes($message);
		if(is_null($entities) === false):
			$writer->tgwriteVector($entities,'MessageEntity');
		endif;
		if(is_null($media) === false):
			$writer->write($media->read());
		endif;
		$writer->writeInt($date);
		if(is_null($effect) === false):
			$writer->writeLong($effect);
		endif;
		if(is_null($suggested_post) === false):
			$writer->write($suggested_post->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 1)):
			$result['no_webpage'] = true;
		else:
			$result['no_webpage'] = false;
		endif;
		if($flags & (1 << 6)):
			$result['invert_media'] = true;
		else:
			$result['invert_media'] = false;
		endif;
		if($flags & (1 << 4)):
			$result['reply_to'] = $reader->tgreadObject();
		else:
			$result['reply_to'] = null;
		endif;
		$result['message'] = $reader->tgreadBytes();
		if($flags & (1 << 3)):
			$result['entities'] = $reader->tgreadVector('MessageEntity');
		else:
			$result['entities'] = null;
		endif;
		if($flags & (1 << 5)):
			$result['media'] = $reader->tgreadObject();
		else:
			$result['media'] = null;
		endif;
		$result['date'] = $reader->readInt();
		if($flags & (1 << 7)):
			$result['effect'] = $reader->readLong();
		else:
			$result['effect'] = null;
		endif;
		if($flags & (1 << 8)):
			$result['suggested_post'] = $reader->tgreadObject();
		else:
			$result['suggested_post'] = null;
		endif;
		return new self($result);
	}
}

?>