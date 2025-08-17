<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string id starsamount amount int date starstransactionpeer peer true refund true pending true failed true gift true reaction true stargift_upgrade true business_transfer true stargift_resale string title string description webdocument photo int transaction_date string transaction_url bytes bot_payload int msg_id Vector<MessageMedia> extended_media int subscription_period int giveaway_post_id stargift stargift int floodskip_number int starref_commission_permille peer starref_peer starsamount starref_amount int paid_messages int premium_gift_months int ads_proceeds_from_date int ads_proceeds_to_date
 * @return StarsTransaction
 */

final class StarsTransaction extends Instance {
	public function request(string $id,object $amount,int $date,object $peer,? true $refund = null,? true $pending = null,? true $failed = null,? true $gift = null,? true $reaction = null,? true $stargift_upgrade = null,? true $business_transfer = null,? true $stargift_resale = null,? string $title = null,? string $description = null,? object $photo = null,? int $transaction_date = null,? string $transaction_url = null,? string $bot_payload = null,? int $msg_id = null,? array $extended_media = null,? int $subscription_period = null,? int $giveaway_post_id = null,? object $stargift = null,? int $floodskip_number = null,? int $starref_commission_permille = null,? object $starref_peer = null,? object $starref_amount = null,? int $paid_messages = null,? int $premium_gift_months = null,? int $ads_proceeds_from_date = null,? int $ads_proceeds_to_date = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x13659eb0);
		$flags = 0;
		$flags |= is_null($refund) ? 0 : (1 << 3);
		$flags |= is_null($pending) ? 0 : (1 << 4);
		$flags |= is_null($failed) ? 0 : (1 << 6);
		$flags |= is_null($gift) ? 0 : (1 << 10);
		$flags |= is_null($reaction) ? 0 : (1 << 11);
		$flags |= is_null($stargift_upgrade) ? 0 : (1 << 18);
		$flags |= is_null($business_transfer) ? 0 : (1 << 21);
		$flags |= is_null($stargift_resale) ? 0 : (1 << 22);
		$flags |= is_null($title) ? 0 : (1 << 0);
		$flags |= is_null($description) ? 0 : (1 << 1);
		$flags |= is_null($photo) ? 0 : (1 << 2);
		$flags |= is_null($transaction_date) ? 0 : (1 << 5);
		$flags |= is_null($transaction_url) ? 0 : (1 << 5);
		$flags |= is_null($bot_payload) ? 0 : (1 << 7);
		$flags |= is_null($msg_id) ? 0 : (1 << 8);
		$flags |= is_null($extended_media) ? 0 : (1 << 9);
		$flags |= is_null($subscription_period) ? 0 : (1 << 12);
		$flags |= is_null($giveaway_post_id) ? 0 : (1 << 13);
		$flags |= is_null($stargift) ? 0 : (1 << 14);
		$flags |= is_null($floodskip_number) ? 0 : (1 << 15);
		$flags |= is_null($starref_commission_permille) ? 0 : (1 << 16);
		$flags |= is_null($starref_peer) ? 0 : (1 << 17);
		$flags |= is_null($starref_amount) ? 0 : (1 << 17);
		$flags |= is_null($paid_messages) ? 0 : (1 << 19);
		$flags |= is_null($premium_gift_months) ? 0 : (1 << 20);
		$flags |= is_null($ads_proceeds_from_date) ? 0 : (1 << 23);
		$flags |= is_null($ads_proceeds_to_date) ? 0 : (1 << 23);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($id);
		$writer->write($amount->read());
		$writer->writeInt($date);
		$writer->write($peer->read());
		if(is_null($title) === false):
			$writer->tgwriteBytes($title);
		endif;
		if(is_null($description) === false):
			$writer->tgwriteBytes($description);
		endif;
		if(is_null($photo) === false):
			$writer->write($photo->read());
		endif;
		if(is_null($transaction_date) === false):
			$writer->writeInt($transaction_date);
		endif;
		if(is_null($transaction_url) === false):
			$writer->tgwriteBytes($transaction_url);
		endif;
		if(is_null($bot_payload) === false):
			$writer->tgwriteBytes($bot_payload);
		endif;
		if(is_null($msg_id) === false):
			$writer->writeInt($msg_id);
		endif;
		if(is_null($extended_media) === false):
			$writer->tgwriteVector($extended_media,'MessageMedia');
		endif;
		if(is_null($subscription_period) === false):
			$writer->writeInt($subscription_period);
		endif;
		if(is_null($giveaway_post_id) === false):
			$writer->writeInt($giveaway_post_id);
		endif;
		if(is_null($stargift) === false):
			$writer->write($stargift->read());
		endif;
		if(is_null($floodskip_number) === false):
			$writer->writeInt($floodskip_number);
		endif;
		if(is_null($starref_commission_permille) === false):
			$writer->writeInt($starref_commission_permille);
		endif;
		if(is_null($starref_peer) === false):
			$writer->write($starref_peer->read());
		endif;
		if(is_null($starref_amount) === false):
			$writer->write($starref_amount->read());
		endif;
		if(is_null($paid_messages) === false):
			$writer->writeInt($paid_messages);
		endif;
		if(is_null($premium_gift_months) === false):
			$writer->writeInt($premium_gift_months);
		endif;
		if(is_null($ads_proceeds_from_date) === false):
			$writer->writeInt($ads_proceeds_from_date);
		endif;
		if(is_null($ads_proceeds_to_date) === false):
			$writer->writeInt($ads_proceeds_to_date);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 3)):
			$result['refund'] = true;
		else:
			$result['refund'] = false;
		endif;
		if($flags & (1 << 4)):
			$result['pending'] = true;
		else:
			$result['pending'] = false;
		endif;
		if($flags & (1 << 6)):
			$result['failed'] = true;
		else:
			$result['failed'] = false;
		endif;
		if($flags & (1 << 10)):
			$result['gift'] = true;
		else:
			$result['gift'] = false;
		endif;
		if($flags & (1 << 11)):
			$result['reaction'] = true;
		else:
			$result['reaction'] = false;
		endif;
		if($flags & (1 << 18)):
			$result['stargift_upgrade'] = true;
		else:
			$result['stargift_upgrade'] = false;
		endif;
		if($flags & (1 << 21)):
			$result['business_transfer'] = true;
		else:
			$result['business_transfer'] = false;
		endif;
		if($flags & (1 << 22)):
			$result['stargift_resale'] = true;
		else:
			$result['stargift_resale'] = false;
		endif;
		$result['id'] = $reader->tgreadBytes();
		$result['amount'] = $reader->tgreadObject();
		$result['date'] = $reader->readInt();
		$result['peer'] = $reader->tgreadObject();
		if($flags & (1 << 0)):
			$result['title'] = $reader->tgreadBytes();
		else:
			$result['title'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['description'] = $reader->tgreadBytes();
		else:
			$result['description'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['photo'] = $reader->tgreadObject();
		else:
			$result['photo'] = null;
		endif;
		if($flags & (1 << 5)):
			$result['transaction_date'] = $reader->readInt();
		else:
			$result['transaction_date'] = null;
		endif;
		if($flags & (1 << 5)):
			$result['transaction_url'] = $reader->tgreadBytes();
		else:
			$result['transaction_url'] = null;
		endif;
		if($flags & (1 << 7)):
			$result['bot_payload'] = $reader->tgreadBytes();
		else:
			$result['bot_payload'] = null;
		endif;
		if($flags & (1 << 8)):
			$result['msg_id'] = $reader->readInt();
		else:
			$result['msg_id'] = null;
		endif;
		if($flags & (1 << 9)):
			$result['extended_media'] = $reader->tgreadVector('MessageMedia');
		else:
			$result['extended_media'] = null;
		endif;
		if($flags & (1 << 12)):
			$result['subscription_period'] = $reader->readInt();
		else:
			$result['subscription_period'] = null;
		endif;
		if($flags & (1 << 13)):
			$result['giveaway_post_id'] = $reader->readInt();
		else:
			$result['giveaway_post_id'] = null;
		endif;
		if($flags & (1 << 14)):
			$result['stargift'] = $reader->tgreadObject();
		else:
			$result['stargift'] = null;
		endif;
		if($flags & (1 << 15)):
			$result['floodskip_number'] = $reader->readInt();
		else:
			$result['floodskip_number'] = null;
		endif;
		if($flags & (1 << 16)):
			$result['starref_commission_permille'] = $reader->readInt();
		else:
			$result['starref_commission_permille'] = null;
		endif;
		if($flags & (1 << 17)):
			$result['starref_peer'] = $reader->tgreadObject();
		else:
			$result['starref_peer'] = null;
		endif;
		if($flags & (1 << 17)):
			$result['starref_amount'] = $reader->tgreadObject();
		else:
			$result['starref_amount'] = null;
		endif;
		if($flags & (1 << 19)):
			$result['paid_messages'] = $reader->readInt();
		else:
			$result['paid_messages'] = null;
		endif;
		if($flags & (1 << 20)):
			$result['premium_gift_months'] = $reader->readInt();
		else:
			$result['premium_gift_months'] = null;
		endif;
		if($flags & (1 << 23)):
			$result['ads_proceeds_from_date'] = $reader->readInt();
		else:
			$result['ads_proceeds_from_date'] = null;
		endif;
		if($flags & (1 << 23)):
			$result['ads_proceeds_to_date'] = $reader->readInt();
		else:
			$result['ads_proceeds_to_date'] = null;
		endif;
		return new self($result);
	}
}

?>