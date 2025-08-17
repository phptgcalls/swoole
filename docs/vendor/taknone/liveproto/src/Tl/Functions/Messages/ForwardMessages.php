<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer from_peer Vector<int> id Vector<long> random_id inputpeer to_peer true silent true background true with_my_score true drop_author true drop_media_captions true noforwards true allow_paid_floodskip int top_msg_id inputreplyto reply_to int schedule_date inputpeer send_as inputquickreplyshortcut quick_reply_shortcut int video_timestamp long allow_paid_stars suggestedpost suggested_post
 * @return Updates
 */

final class ForwardMessages extends Instance {
	public function request(object $from_peer,array $id,array $random_id,object $to_peer,? true $silent = null,? true $background = null,? true $with_my_score = null,? true $drop_author = null,? true $drop_media_captions = null,? true $noforwards = null,? true $allow_paid_floodskip = null,? int $top_msg_id = null,? object $reply_to = null,? int $schedule_date = null,? object $send_as = null,? object $quick_reply_shortcut = null,? int $video_timestamp = null,? int $allow_paid_stars = null,? object $suggested_post = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x978928ca);
		$flags = 0;
		$flags |= is_null($silent) ? 0 : (1 << 5);
		$flags |= is_null($background) ? 0 : (1 << 6);
		$flags |= is_null($with_my_score) ? 0 : (1 << 8);
		$flags |= is_null($drop_author) ? 0 : (1 << 11);
		$flags |= is_null($drop_media_captions) ? 0 : (1 << 12);
		$flags |= is_null($noforwards) ? 0 : (1 << 14);
		$flags |= is_null($allow_paid_floodskip) ? 0 : (1 << 19);
		$flags |= is_null($top_msg_id) ? 0 : (1 << 9);
		$flags |= is_null($reply_to) ? 0 : (1 << 22);
		$flags |= is_null($schedule_date) ? 0 : (1 << 10);
		$flags |= is_null($send_as) ? 0 : (1 << 13);
		$flags |= is_null($quick_reply_shortcut) ? 0 : (1 << 17);
		$flags |= is_null($video_timestamp) ? 0 : (1 << 20);
		$flags |= is_null($allow_paid_stars) ? 0 : (1 << 21);
		$flags |= is_null($suggested_post) ? 0 : (1 << 23);
		$writer->writeInt($flags);
		$writer->write($from_peer->read());
		$writer->tgwriteVector($id,'int');
		$writer->tgwriteVector($random_id,'long');
		$writer->write($to_peer->read());
		if(is_null($top_msg_id) === false):
			$writer->writeInt($top_msg_id);
		endif;
		if(is_null($reply_to) === false):
			$writer->write($reply_to->read());
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
		if(is_null($video_timestamp) === false):
			$writer->writeInt($video_timestamp);
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