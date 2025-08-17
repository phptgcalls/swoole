<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer long random_id long query_id string id true silent true background true clear_draft true hide_via inputreplyto reply_to int schedule_date inputpeer send_as inputquickreplyshortcut quick_reply_shortcut long allow_paid_stars
 * @return Updates
 */

final class SendInlineBotResult extends Instance {
	public function request(object $peer,int $random_id,int $query_id,string $id,? true $silent = null,? true $background = null,? true $clear_draft = null,? true $hide_via = null,? object $reply_to = null,? int $schedule_date = null,? object $send_as = null,? object $quick_reply_shortcut = null,? int $allow_paid_stars = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc0cf7646);
		$flags = 0;
		$flags |= is_null($silent) ? 0 : (1 << 5);
		$flags |= is_null($background) ? 0 : (1 << 6);
		$flags |= is_null($clear_draft) ? 0 : (1 << 7);
		$flags |= is_null($hide_via) ? 0 : (1 << 11);
		$flags |= is_null($reply_to) ? 0 : (1 << 0);
		$flags |= is_null($schedule_date) ? 0 : (1 << 10);
		$flags |= is_null($send_as) ? 0 : (1 << 13);
		$flags |= is_null($quick_reply_shortcut) ? 0 : (1 << 17);
		$flags |= is_null($allow_paid_stars) ? 0 : (1 << 21);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		if(is_null($reply_to) === false):
			$writer->write($reply_to->read());
		endif;
		$writer->writeLong($random_id);
		$writer->writeLong($query_id);
		$writer->tgwriteBytes($id);
		if(is_null($schedule_date) === false):
			$writer->writeInt($schedule_date);
		endif;
		if(is_null($send_as) === false):
			$writer->write($send_as->read());
		endif;
		if(is_null($quick_reply_shortcut) === false):
			$writer->write($quick_reply_shortcut->read());
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