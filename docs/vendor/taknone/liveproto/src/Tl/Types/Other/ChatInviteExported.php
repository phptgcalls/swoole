<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string link long admin_id int date true revoked true permanent true request_needed int start_date int expire_date int usage_limit int usage int requested int subscription_expired string title starssubscriptionpricing subscription_pricing
 * @return ExportedChatInvite
 */

final class ChatInviteExported extends Instance {
	public function request(string $link,int $admin_id,int $date,? true $revoked = null,? true $permanent = null,? true $request_needed = null,? int $start_date = null,? int $expire_date = null,? int $usage_limit = null,? int $usage = null,? int $requested = null,? int $subscription_expired = null,? string $title = null,? object $subscription_pricing = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa22cbd96);
		$flags = 0;
		$flags |= is_null($revoked) ? 0 : (1 << 0);
		$flags |= is_null($permanent) ? 0 : (1 << 5);
		$flags |= is_null($request_needed) ? 0 : (1 << 6);
		$flags |= is_null($start_date) ? 0 : (1 << 4);
		$flags |= is_null($expire_date) ? 0 : (1 << 1);
		$flags |= is_null($usage_limit) ? 0 : (1 << 2);
		$flags |= is_null($usage) ? 0 : (1 << 3);
		$flags |= is_null($requested) ? 0 : (1 << 7);
		$flags |= is_null($subscription_expired) ? 0 : (1 << 10);
		$flags |= is_null($title) ? 0 : (1 << 8);
		$flags |= is_null($subscription_pricing) ? 0 : (1 << 9);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($link);
		$writer->writeLong($admin_id);
		$writer->writeInt($date);
		if(is_null($start_date) === false):
			$writer->writeInt($start_date);
		endif;
		if(is_null($expire_date) === false):
			$writer->writeInt($expire_date);
		endif;
		if(is_null($usage_limit) === false):
			$writer->writeInt($usage_limit);
		endif;
		if(is_null($usage) === false):
			$writer->writeInt($usage);
		endif;
		if(is_null($requested) === false):
			$writer->writeInt($requested);
		endif;
		if(is_null($subscription_expired) === false):
			$writer->writeInt($subscription_expired);
		endif;
		if(is_null($title) === false):
			$writer->tgwriteBytes($title);
		endif;
		if(is_null($subscription_pricing) === false):
			$writer->write($subscription_pricing->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['revoked'] = true;
		else:
			$result['revoked'] = false;
		endif;
		if($flags & (1 << 5)):
			$result['permanent'] = true;
		else:
			$result['permanent'] = false;
		endif;
		if($flags & (1 << 6)):
			$result['request_needed'] = true;
		else:
			$result['request_needed'] = false;
		endif;
		$result['link'] = $reader->tgreadBytes();
		$result['admin_id'] = $reader->readLong();
		$result['date'] = $reader->readInt();
		if($flags & (1 << 4)):
			$result['start_date'] = $reader->readInt();
		else:
			$result['start_date'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['expire_date'] = $reader->readInt();
		else:
			$result['expire_date'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['usage_limit'] = $reader->readInt();
		else:
			$result['usage_limit'] = null;
		endif;
		if($flags & (1 << 3)):
			$result['usage'] = $reader->readInt();
		else:
			$result['usage'] = null;
		endif;
		if($flags & (1 << 7)):
			$result['requested'] = $reader->readInt();
		else:
			$result['requested'] = null;
		endif;
		if($flags & (1 << 10)):
			$result['subscription_expired'] = $reader->readInt();
		else:
			$result['subscription_expired'] = null;
		endif;
		if($flags & (1 << 8)):
			$result['title'] = $reader->tgreadBytes();
		else:
			$result['title'] = null;
		endif;
		if($flags & (1 << 9)):
			$result['subscription_pricing'] = $reader->tgreadObject();
		else:
			$result['subscription_pricing'] = null;
		endif;
		return new self($result);
	}
}

?>