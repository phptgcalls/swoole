<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer string message long random_id true no_webpage true silent true background true clear_draft true noforwards true update_stickersets_order true invert_media true allow_paid_floodskip inputreplyto reply_to replymarkup reply_markup Vector<MessageEntity> entities int schedule_date inputpeer send_as inputquickreplyshortcut quick_reply_shortcut long effect long allow_paid_stars suggestedpost suggested_post
 * @return Updates
 */

final class SendMessage extends Instance {
	public function request(object $peer,string $message,int $random_id,? true $no_webpage = null,? true $silent = null,? true $background = null,? true $clear_draft = null,? true $noforwards = null,? true $update_stickersets_order = null,? true $invert_media = null,? true $allow_paid_floodskip = null,? object $reply_to = null,? object $reply_markup = null,? array $entities = null,? int $schedule_date = null,? object $send_as = null,? object $quick_reply_shortcut = null,? int $effect = null,? int $allow_paid_stars = null,? object $suggested_post = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xfe05dc9a);
		$flags = 0;
		$flags |= is_null($no_webpage) ? 0 : (1 << 1);
		$flags |= is_null($silent) ? 0 : (1 << 5);
		$flags |= is_null($background) ? 0 : (1 << 6);
		$flags |= is_null($clear_draft) ? 0 : (1 << 7);
		$flags |= is_null($noforwards) ? 0 : (1 << 14);
		$flags |= is_null($update_stickersets_order) ? 0 : (1 << 15);
		$flags |= is_null($invert_media) ? 0 : (1 << 16);
		$flags |= is_null($allow_paid_floodskip) ? 0 : (1 << 19);
		$flags |= is_null($reply_to) ? 0 : (1 << 0);
		$flags |= is_null($reply_markup) ? 0 : (1 << 2);
		$flags |= is_null($entities) ? 0 : (1 << 3);
		$flags |= is_null($schedule_date) ? 0 : (1 << 10);
		$flags |= is_null($send_as) ? 0 : (1 << 13);
		$flags |= is_null($quick_reply_shortcut) ? 0 : (1 << 17);
		$flags |= is_null($effect) ? 0 : (1 << 18);
		$flags |= is_null($allow_paid_stars) ? 0 : (1 << 21);
		$flags |= is_null($suggested_post) ? 0 : (1 << 22);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		if(is_null($reply_to) === false):
			$writer->write($reply_to->read());
		endif;
		$writer->tgwriteBytes($message);
		$writer->writeLong($random_id);
		if(is_null($reply_markup) === false):
			$writer->write($reply_markup->read());
		endif;
		if(is_null($entities) === false):
			$writer->tgwriteVector($entities,'MessageEntity');
		endif;
		if(is_null($schedule_date) === false):
			$writer->writeInt($schedule_date);
		endif;
		if(is_null($send_as) === false):
			$writer->write($send_as->read());
		endif;
		if(is_null($quick_reply_shortcut) === false):
			$writer->write($quick_reply_shortcut->read());
		endif;
		if(is_null($effect) === false):
			$writer->writeLong($effect);
		endif;
		if(is_null($allow_paid_stars) === false):
			$writer->writeLong($allow_paid_stars);
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