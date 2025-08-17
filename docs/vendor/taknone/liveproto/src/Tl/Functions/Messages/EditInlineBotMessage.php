<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputbotinlinemessageid id true no_webpage true invert_media string message inputmedia media replymarkup reply_markup Vector<MessageEntity> entities
 * @return Bool
 */

final class EditInlineBotMessage extends Instance {
	public function request(object $id,? true $no_webpage = null,? true $invert_media = null,? string $message = null,? object $media = null,? object $reply_markup = null,? array $entities = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x83557dba);
		$flags = 0;
		$flags |= is_null($no_webpage) ? 0 : (1 << 1);
		$flags |= is_null($invert_media) ? 0 : (1 << 16);
		$flags |= is_null($message) ? 0 : (1 << 11);
		$flags |= is_null($media) ? 0 : (1 << 14);
		$flags |= is_null($reply_markup) ? 0 : (1 << 2);
		$flags |= is_null($entities) ? 0 : (1 << 3);
		$writer->writeInt($flags);
		$writer->write($id->read());
		if(is_null($message) === false):
			$writer->tgwriteBytes($message);
		endif;
		if(is_null($media) === false):
			$writer->write($media->read());
		endif;
		if(is_null($reply_markup) === false):
			$writer->write($reply_markup->read());
		endif;
		if(is_null($entities) === false):
			$writer->tgwriteVector($entities,'MessageEntity');
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