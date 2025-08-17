<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer true legacy_revoke_permanent true request_needed int expire_date int usage_limit string title starssubscriptionpricing subscription_pricing
 * @return ExportedChatInvite
 */

final class ExportChatInvite extends Instance {
	public function request(object $peer,? true $legacy_revoke_permanent = null,? true $request_needed = null,? int $expire_date = null,? int $usage_limit = null,? string $title = null,? object $subscription_pricing = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa455de90);
		$flags = 0;
		$flags |= is_null($legacy_revoke_permanent) ? 0 : (1 << 2);
		$flags |= is_null($request_needed) ? 0 : (1 << 3);
		$flags |= is_null($expire_date) ? 0 : (1 << 0);
		$flags |= is_null($usage_limit) ? 0 : (1 << 1);
		$flags |= is_null($title) ? 0 : (1 << 4);
		$flags |= is_null($subscription_pricing) ? 0 : (1 << 5);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		if(is_null($expire_date) === false):
			$writer->writeInt($expire_date);
		endif;
		if(is_null($usage_limit) === false):
			$writer->writeInt($usage_limit);
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
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>