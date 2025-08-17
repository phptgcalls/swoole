<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string id peer peer int until_date starssubscriptionpricing pricing true canceled true can_refulfill true missing_balance true bot_canceled string chat_invite_hash string title webdocument photo string invoice_slug
 * @return StarsSubscription
 */

final class StarsSubscription extends Instance {
	public function request(string $id,object $peer,int $until_date,object $pricing,? true $canceled = null,? true $can_refulfill = null,? true $missing_balance = null,? true $bot_canceled = null,? string $chat_invite_hash = null,? string $title = null,? object $photo = null,? string $invoice_slug = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x2e6eab1a);
		$flags = 0;
		$flags |= is_null($canceled) ? 0 : (1 << 0);
		$flags |= is_null($can_refulfill) ? 0 : (1 << 1);
		$flags |= is_null($missing_balance) ? 0 : (1 << 2);
		$flags |= is_null($bot_canceled) ? 0 : (1 << 7);
		$flags |= is_null($chat_invite_hash) ? 0 : (1 << 3);
		$flags |= is_null($title) ? 0 : (1 << 4);
		$flags |= is_null($photo) ? 0 : (1 << 5);
		$flags |= is_null($invoice_slug) ? 0 : (1 << 6);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($id);
		$writer->write($peer->read());
		$writer->writeInt($until_date);
		$writer->write($pricing->read());
		if(is_null($chat_invite_hash) === false):
			$writer->tgwriteBytes($chat_invite_hash);
		endif;
		if(is_null($title) === false):
			$writer->tgwriteBytes($title);
		endif;
		if(is_null($photo) === false):
			$writer->write($photo->read());
		endif;
		if(is_null($invoice_slug) === false):
			$writer->tgwriteBytes($invoice_slug);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['canceled'] = true;
		else:
			$result['canceled'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['can_refulfill'] = true;
		else:
			$result['can_refulfill'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['missing_balance'] = true;
		else:
			$result['missing_balance'] = false;
		endif;
		if($flags & (1 << 7)):
			$result['bot_canceled'] = true;
		else:
			$result['bot_canceled'] = false;
		endif;
		$result['id'] = $reader->tgreadBytes();
		$result['peer'] = $reader->tgreadObject();
		$result['until_date'] = $reader->readInt();
		$result['pricing'] = $reader->tgreadObject();
		if($flags & (1 << 3)):
			$result['chat_invite_hash'] = $reader->tgreadBytes();
		else:
			$result['chat_invite_hash'] = null;
		endif;
		if($flags & (1 << 4)):
			$result['title'] = $reader->tgreadBytes();
		else:
			$result['title'] = null;
		endif;
		if($flags & (1 << 5)):
			$result['photo'] = $reader->tgreadObject();
		else:
			$result['photo'] = null;
		endif;
		if($flags & (1 << 6)):
			$result['invoice_slug'] = $reader->tgreadBytes();
		else:
			$result['invoice_slug'] = null;
		endif;
		return new self($result);
	}
}

?>