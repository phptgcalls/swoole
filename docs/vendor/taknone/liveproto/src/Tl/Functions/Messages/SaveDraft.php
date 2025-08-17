<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer string message true no_webpage true invert_media inputreplyto reply_to Vector<MessageEntity> entities inputmedia media long effect suggestedpost suggested_post
 * @return Bool
 */

final class SaveDraft extends Instance {
	public function request(object $peer,string $message,? true $no_webpage = null,? true $invert_media = null,? object $reply_to = null,? array $entities = null,? object $media = null,? int $effect = null,? object $suggested_post = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x54ae308e);
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
		$writer->write($peer->read());
		$writer->tgwriteBytes($message);
		if(is_null($entities) === false):
			$writer->tgwriteVector($entities,'MessageEntity');
		endif;
		if(is_null($media) === false):
			$writer->write($media->read());
		endif;
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
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>