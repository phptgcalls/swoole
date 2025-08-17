<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer Vector<InputSingleMedia> multi_media true silent true background true clear_draft true noforwards true update_stickersets_order true invert_media true allow_paid_floodskip inputreplyto reply_to int schedule_date inputpeer send_as inputquickreplyshortcut quick_reply_shortcut long effect long allow_paid_stars
 * @return Updates
 */

final class SendMultiMedia extends Instance {
	public function request(object $peer,array $multi_media,? true $silent = null,? true $background = null,? true $clear_draft = null,? true $noforwards = null,? true $update_stickersets_order = null,? true $invert_media = null,? true $allow_paid_floodskip = null,? object $reply_to = null,? int $schedule_date = null,? object $send_as = null,? object $quick_reply_shortcut = null,? int $effect = null,? int $allow_paid_stars = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x1bf89d74);
		$flags = 0;
		$flags |= is_null($silent) ? 0 : (1 << 5);
		$flags |= is_null($background) ? 0 : (1 << 6);
		$flags |= is_null($clear_draft) ? 0 : (1 << 7);
		$flags |= is_null($noforwards) ? 0 : (1 << 14);
		$flags |= is_null($update_stickersets_order) ? 0 : (1 << 15);
		$flags |= is_null($invert_media) ? 0 : (1 << 16);
		$flags |= is_null($allow_paid_floodskip) ? 0 : (1 << 19);
		$flags |= is_null($reply_to) ? 0 : (1 << 0);
		$flags |= is_null($schedule_date) ? 0 : (1 << 10);
		$flags |= is_null($send_as) ? 0 : (1 << 13);
		$flags |= is_null($quick_reply_shortcut) ? 0 : (1 << 17);
		$flags |= is_null($effect) ? 0 : (1 << 18);
		$flags |= is_null($allow_paid_stars) ? 0 : (1 << 21);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		if(is_null($reply_to) === false):
			$writer->write($reply_to->read());
		endif;
		$writer->tgwriteVector($multi_media,'InputSingleMedia');
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
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>