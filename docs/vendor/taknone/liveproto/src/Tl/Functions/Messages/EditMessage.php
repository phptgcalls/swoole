<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int id true no_webpage true invert_media string message inputmedia media replymarkup reply_markup Vector<MessageEntity> entities int schedule_date int quick_reply_shortcut_id
 * @return Updates
 */

final class EditMessage extends Instance {
	public function request(object $peer,int $id,? true $no_webpage = null,? true $invert_media = null,? string $message = null,? object $media = null,? object $reply_markup = null,? array $entities = null,? int $schedule_date = null,? int $quick_reply_shortcut_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xdfd14005);
		$flags = 0;
		$flags |= is_null($no_webpage) ? 0 : (1 << 1);
		$flags |= is_null($invert_media) ? 0 : (1 << 16);
		$flags |= is_null($message) ? 0 : (1 << 11);
		$flags |= is_null($media) ? 0 : (1 << 14);
		$flags |= is_null($reply_markup) ? 0 : (1 << 2);
		$flags |= is_null($entities) ? 0 : (1 << 3);
		$flags |= is_null($schedule_date) ? 0 : (1 << 15);
		$flags |= is_null($quick_reply_shortcut_id) ? 0 : (1 << 17);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		$writer->writeInt($id);
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
		if(is_null($schedule_date) === false):
			$writer->writeInt($schedule_date);
		endif;
		if(is_null($quick_reply_shortcut_id) === false):
			$writer->writeInt($quick_reply_shortcut_id);
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