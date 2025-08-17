<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int id peer peer_id int date string message true out true mentioned true media_unread true silent true post true from_scheduled true legacy true edit_hide true pinned true noforwards true invert_media true offline true video_processing_pending true paid_suggested_post_stars true paid_suggested_post_ton peer from_id int from_boosts_applied peer saved_peer_id messagefwdheader fwd_from long via_bot_id long via_business_bot_id messagereplyheader reply_to messagemedia media replymarkup reply_markup Vector<MessageEntity> entities int views int forwards messagereplies replies int edit_date string post_author long grouped_id messagereactions reactions Vector<RestrictionReason> restriction_reason int ttl_period int quick_reply_shortcut_id long effect factcheck factcheck int report_delivery_until_date long paid_message_stars suggestedpost suggested_post
 * @return Message
 */

final class Message extends Instance {
	public function request(int $id,object $peer_id,int $date,string $message,? true $out = null,? true $mentioned = null,? true $media_unread = null,? true $silent = null,? true $post = null,? true $from_scheduled = null,? true $legacy = null,? true $edit_hide = null,? true $pinned = null,? true $noforwards = null,? true $invert_media = null,? true $offline = null,? true $video_processing_pending = null,? true $paid_suggested_post_stars = null,? true $paid_suggested_post_ton = null,? object $from_id = null,? int $from_boosts_applied = null,? object $saved_peer_id = null,? object $fwd_from = null,? int $via_bot_id = null,? int $via_business_bot_id = null,? object $reply_to = null,? object $media = null,? object $reply_markup = null,? array $entities = null,? int $views = null,? int $forwards = null,? object $replies = null,? int $edit_date = null,? string $post_author = null,? int $grouped_id = null,? object $reactions = null,? array $restriction_reason = null,? int $ttl_period = null,? int $quick_reply_shortcut_id = null,? int $effect = null,? object $factcheck = null,? int $report_delivery_until_date = null,? int $paid_message_stars = null,? object $suggested_post = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9815cec8);
		$flags = 0;
		$flags |= is_null($out) ? 0 : (1 << 1);
		$flags |= is_null($mentioned) ? 0 : (1 << 4);
		$flags |= is_null($media_unread) ? 0 : (1 << 5);
		$flags |= is_null($silent) ? 0 : (1 << 13);
		$flags |= is_null($post) ? 0 : (1 << 14);
		$flags |= is_null($from_scheduled) ? 0 : (1 << 18);
		$flags |= is_null($legacy) ? 0 : (1 << 19);
		$flags |= is_null($edit_hide) ? 0 : (1 << 21);
		$flags |= is_null($pinned) ? 0 : (1 << 24);
		$flags |= is_null($noforwards) ? 0 : (1 << 26);
		$flags |= is_null($invert_media) ? 0 : (1 << 27);
		$flags |= is_null($from_id) ? 0 : (1 << 8);
		$flags |= is_null($from_boosts_applied) ? 0 : (1 << 29);
		$flags |= is_null($saved_peer_id) ? 0 : (1 << 28);
		$flags |= is_null($fwd_from) ? 0 : (1 << 2);
		$flags |= is_null($via_bot_id) ? 0 : (1 << 11);
		$flags |= is_null($reply_to) ? 0 : (1 << 3);
		$flags |= is_null($media) ? 0 : (1 << 9);
		$flags |= is_null($reply_markup) ? 0 : (1 << 6);
		$flags |= is_null($entities) ? 0 : (1 << 7);
		$flags |= is_null($views) ? 0 : (1 << 10);
		$flags |= is_null($forwards) ? 0 : (1 << 10);
		$flags |= is_null($replies) ? 0 : (1 << 23);
		$flags |= is_null($edit_date) ? 0 : (1 << 15);
		$flags |= is_null($post_author) ? 0 : (1 << 16);
		$flags |= is_null($grouped_id) ? 0 : (1 << 17);
		$flags |= is_null($reactions) ? 0 : (1 << 20);
		$flags |= is_null($restriction_reason) ? 0 : (1 << 22);
		$flags |= is_null($ttl_period) ? 0 : (1 << 25);
		$flags |= is_null($quick_reply_shortcut_id) ? 0 : (1 << 30);
		$writer->writeInt($flags);
		$flags2 = 0;
		$flags2 |= is_null($offline) ? 0 : (1 << 1);
		$flags2 |= is_null($video_processing_pending) ? 0 : (1 << 4);
		$flags2 |= is_null($paid_suggested_post_stars) ? 0 : (1 << 8);
		$flags2 |= is_null($paid_suggested_post_ton) ? 0 : (1 << 9);
		$flags2 |= is_null($via_business_bot_id) ? 0 : (1 << 0);
		$flags2 |= is_null($effect) ? 0 : (1 << 2);
		$flags2 |= is_null($factcheck) ? 0 : (1 << 3);
		$flags2 |= is_null($report_delivery_until_date) ? 0 : (1 << 5);
		$flags2 |= is_null($paid_message_stars) ? 0 : (1 << 6);
		$flags2 |= is_null($suggested_post) ? 0 : (1 << 7);
		$writer->writeInt($flags2);
		$writer->writeInt($id);
		if(is_null($from_id) === false):
			$writer->write($from_id->read());
		endif;
		if(is_null($from_boosts_applied) === false):
			$writer->writeInt($from_boosts_applied);
		endif;
		$writer->write($peer_id->read());
		if(is_null($saved_peer_id) === false):
			$writer->write($saved_peer_id->read());
		endif;
		if(is_null($fwd_from) === false):
			$writer->write($fwd_from->read());
		endif;
		if(is_null($via_bot_id) === false):
			$writer->writeLong($via_bot_id);
		endif;
		if(is_null($via_business_bot_id) === false):
			$writer->writeLong($via_business_bot_id);
		endif;
		if(is_null($reply_to) === false):
			$writer->write($reply_to->read());
		endif;
		$writer->writeInt($date);
		$writer->tgwriteBytes($message);
		if(is_null($media) === false):
			$writer->write($media->read());
		endif;
		if(is_null($reply_markup) === false):
			$writer->write($reply_markup->read());
		endif;
		if(is_null($entities) === false):
			$writer->tgwriteVector($entities,'MessageEntity');
		endif;
		if(is_null($views) === false):
			$writer->writeInt($views);
		endif;
		if(is_null($forwards) === false):
			$writer->writeInt($forwards);
		endif;
		if(is_null($replies) === false):
			$writer->write($replies->read());
		endif;
		if(is_null($edit_date) === false):
			$writer->writeInt($edit_date);
		endif;
		if(is_null($post_author) === false):
			$writer->tgwriteBytes($post_author);
		endif;
		if(is_null($grouped_id) === false):
			$writer->writeLong($grouped_id);
		endif;
		if(is_null($reactions) === false):
			$writer->write($reactions->read());
		endif;
		if(is_null($restriction_reason) === false):
			$writer->tgwriteVector($restriction_reason,'RestrictionReason');
		endif;
		if(is_null($ttl_period) === false):
			$writer->writeInt($ttl_period);
		endif;
		if(is_null($quick_reply_shortcut_id) === false):
			$writer->writeInt($quick_reply_shortcut_id);
		endif;
		if(is_null($effect) === false):
			$writer->writeLong($effect);
		endif;
		if(is_null($factcheck) === false):
			$writer->write($factcheck->read());
		endif;
		if(is_null($report_delivery_until_date) === false):
			$writer->writeInt($report_delivery_until_date);
		endif;
		if(is_null($paid_message_stars) === false):
			$writer->writeLong($paid_message_stars);
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
			$result['out'] = true;
		else:
			$result['out'] = false;
		endif;
		if($flags & (1 << 4)):
			$result['mentioned'] = true;
		else:
			$result['mentioned'] = false;
		endif;
		if($flags & (1 << 5)):
			$result['media_unread'] = true;
		else:
			$result['media_unread'] = false;
		endif;
		if($flags & (1 << 13)):
			$result['silent'] = true;
		else:
			$result['silent'] = false;
		endif;
		if($flags & (1 << 14)):
			$result['post'] = true;
		else:
			$result['post'] = false;
		endif;
		if($flags & (1 << 18)):
			$result['from_scheduled'] = true;
		else:
			$result['from_scheduled'] = false;
		endif;
		if($flags & (1 << 19)):
			$result['legacy'] = true;
		else:
			$result['legacy'] = false;
		endif;
		if($flags & (1 << 21)):
			$result['edit_hide'] = true;
		else:
			$result['edit_hide'] = false;
		endif;
		if($flags & (1 << 24)):
			$result['pinned'] = true;
		else:
			$result['pinned'] = false;
		endif;
		if($flags & (1 << 26)):
			$result['noforwards'] = true;
		else:
			$result['noforwards'] = false;
		endif;
		if($flags & (1 << 27)):
			$result['invert_media'] = true;
		else:
			$result['invert_media'] = false;
		endif;
		$flags2 = $reader->readInt();
		if($flags2 & (1 << 1)):
			$result['offline'] = true;
		else:
			$result['offline'] = false;
		endif;
		if($flags2 & (1 << 4)):
			$result['video_processing_pending'] = true;
		else:
			$result['video_processing_pending'] = false;
		endif;
		if($flags2 & (1 << 8)):
			$result['paid_suggested_post_stars'] = true;
		else:
			$result['paid_suggested_post_stars'] = false;
		endif;
		if($flags2 & (1 << 9)):
			$result['paid_suggested_post_ton'] = true;
		else:
			$result['paid_suggested_post_ton'] = false;
		endif;
		$result['id'] = $reader->readInt();
		if($flags & (1 << 8)):
			$result['from_id'] = $reader->tgreadObject();
		else:
			$result['from_id'] = null;
		endif;
		if($flags & (1 << 29)):
			$result['from_boosts_applied'] = $reader->readInt();
		else:
			$result['from_boosts_applied'] = null;
		endif;
		$result['peer_id'] = $reader->tgreadObject();
		if($flags & (1 << 28)):
			$result['saved_peer_id'] = $reader->tgreadObject();
		else:
			$result['saved_peer_id'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['fwd_from'] = $reader->tgreadObject();
		else:
			$result['fwd_from'] = null;
		endif;
		if($flags & (1 << 11)):
			$result['via_bot_id'] = $reader->readLong();
		else:
			$result['via_bot_id'] = null;
		endif;
		if($flags2 & (1 << 0)):
			$result['via_business_bot_id'] = $reader->readLong();
		else:
			$result['via_business_bot_id'] = null;
		endif;
		if($flags & (1 << 3)):
			$result['reply_to'] = $reader->tgreadObject();
		else:
			$result['reply_to'] = null;
		endif;
		$result['date'] = $reader->readInt();
		$result['message'] = $reader->tgreadBytes();
		if($flags & (1 << 9)):
			$result['media'] = $reader->tgreadObject();
		else:
			$result['media'] = null;
		endif;
		if($flags & (1 << 6)):
			$result['reply_markup'] = $reader->tgreadObject();
		else:
			$result['reply_markup'] = null;
		endif;
		if($flags & (1 << 7)):
			$result['entities'] = $reader->tgreadVector('MessageEntity');
		else:
			$result['entities'] = null;
		endif;
		if($flags & (1 << 10)):
			$result['views'] = $reader->readInt();
		else:
			$result['views'] = null;
		endif;
		if($flags & (1 << 10)):
			$result['forwards'] = $reader->readInt();
		else:
			$result['forwards'] = null;
		endif;
		if($flags & (1 << 23)):
			$result['replies'] = $reader->tgreadObject();
		else:
			$result['replies'] = null;
		endif;
		if($flags & (1 << 15)):
			$result['edit_date'] = $reader->readInt();
		else:
			$result['edit_date'] = null;
		endif;
		if($flags & (1 << 16)):
			$result['post_author'] = $reader->tgreadBytes();
		else:
			$result['post_author'] = null;
		endif;
		if($flags & (1 << 17)):
			$result['grouped_id'] = $reader->readLong();
		else:
			$result['grouped_id'] = null;
		endif;
		if($flags & (1 << 20)):
			$result['reactions'] = $reader->tgreadObject();
		else:
			$result['reactions'] = null;
		endif;
		if($flags & (1 << 22)):
			$result['restriction_reason'] = $reader->tgreadVector('RestrictionReason');
		else:
			$result['restriction_reason'] = null;
		endif;
		if($flags & (1 << 25)):
			$result['ttl_period'] = $reader->readInt();
		else:
			$result['ttl_period'] = null;
		endif;
		if($flags & (1 << 30)):
			$result['quick_reply_shortcut_id'] = $reader->readInt();
		else:
			$result['quick_reply_shortcut_id'] = null;
		endif;
		if($flags2 & (1 << 2)):
			$result['effect'] = $reader->readLong();
		else:
			$result['effect'] = null;
		endif;
		if($flags2 & (1 << 3)):
			$result['factcheck'] = $reader->tgreadObject();
		else:
			$result['factcheck'] = null;
		endif;
		if($flags2 & (1 << 5)):
			$result['report_delivery_until_date'] = $reader->readInt();
		else:
			$result['report_delivery_until_date'] = null;
		endif;
		if($flags2 & (1 << 6)):
			$result['paid_message_stars'] = $reader->readLong();
		else:
			$result['paid_message_stars'] = null;
		endif;
		if($flags2 & (1 << 7)):
			$result['suggested_post'] = $reader->tgreadObject();
		else:
			$result['suggested_post'] = null;
		endif;
		return new self($result);
	}
}

?>